<?php
declare(strict_types=1);

namespace App\Controller;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 */
class BookingsController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
	}

	/*public function viewClasses(): array
    {
        return [JsonView::class];
		return [JsonView::class, XmlView::class];
    }*/
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('bookings', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'bookings');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('bookings.csv');
		$bookings = $this->Bookings->find();
		$_serialize = 'bookings';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('bookings', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
        $this->paginate = [
            'contain' => ['Users', 'Rooms', 'Subjects'],
			'maxLimit' => 10,
        ];
		$bookings = $this->paginate($this->Bookings);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'bookings_List.pdf' 
			]
		);
		$this->set(compact('bookings'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'Bookings List');
		$this->paginate = [
			'maxLimit' => 10,
        ];
        $query = $this->Bookings->find('search', search: $this->request->getQueryParams())
            ->contain(['Users', 'Rooms', 'Subjects']);
			//->where(['title IS NOT' => null])
        $bookings = $this->paginate($query);
		
		//count
		$this->set('total_bookings', $this->Bookings->find()->count());
		$this->set('total_bookings_archived', $this->Bookings->find()->where(['status' => 2])->count());
		$this->set('total_bookings_active', $this->Bookings->find()->where(['status' => 1])->count());
		$this->set('total_bookings_disabled', $this->Bookings->find()->where(['status' => 0])->count());
		
		//Count By Month
		$this->set('january', $this->Bookings->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->Bookings->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->Bookings->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->Bookings->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->Bookings->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->Bookings->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->Bookings->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->Bookings->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->Bookings->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->Bookings->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->Bookings->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->Bookings->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

		$query = $this->Bookings->find();

        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }

        $query->select([
            'count' => $query->func()->count('*'),
            'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
            'month' => 'MONTH(created)',
            'year' => 'YEAR(created)'
        ])
            ->where([
                'created >=' => date('Y-m-01', strtotime('-11 months')),
                'created <=' => date('Y-m-t')
            ])
            ->groupBy(['year', 'month'])
            ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $query->all()->toArray();

        $totalByMonth = [];
        foreach ($expectedMonths as $expectedMonth) {
            $found = false;
            $count = 0;

            foreach ($results as $result) {
                if ($expectedMonth === $result->date) {
                    $found = true;
                    $count = $result->count;
                    break;
                }
            }

            $totalByMonth[] = [
                'month' => $expectedMonth,
                'count' => $count
            ];
        }

        $this->set([
            'results' => $totalByMonth,
            '_serialize' => ['results']
        ]);

        //data as JSON arrays for report chart
        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);
        $monthArray = [];
        $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $this->set(compact('bookings', 'monthArray', 'countArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'Bookings Details');
        $booking = $this->Bookings->get($id, contain: ['Users', 'Rooms', 'Subjects']);
        $this->set(compact('booking'));

        $this->set(compact('booking'));
    }

    public function pdf($id = null)
    {
		$this->viewBuilder()->enableAutoLayout(false);
        $booking = $this->Bookings->get($id, contain: ['Users', 'Rooms', 'Subjects']);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
            'pdsConfig',
            [
                'orientation' => 'potrait',
                'download'=> true,
                'filename' => 'Booking_' . $id . '.pdf'
            ]
            );
        $this->set('booking', $booking);
    }





    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Bookings');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Bookings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $booking = $this->Bookings->newEmptyEntity();
        if ($this->request->is('post')) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
       $users = [
        1 => 'Students',
        2 => 'Lecturer',
        3 => 'UiTM Staff',
    ];

    $this->set(compact('booking', 'users'));

        $rooms = [
            1 => 'Bilik Kuliah 1',
            2 => 'Bilik Kuliah 2',
            3 => 'Bilik Kuliah 3',
            4 => 'Bilik Kuliah 4',
            5 => 'Bilik Kuliah 5',
            6 => 'Makmal Komputer 1',
            7 => 'Makmal Komputer 2',
            8 => 'Makmal Komputer 3',
            9 => 'Makmal Komputer 4',
            10 => 'Makmal Komputer 5',
            11 => 'Dewan Seminar 1',
            12 => 'Dewan Seminar 2',
        ];

        $this->set(compact('rooms'));

        $subjects = [
            1 => 'CDIM260 - Information in Library Science',
            2 => 'CDIM262 - Information in Record Management',
            3 => 'CDIM263 - Introduction in Information System',
            4 => 'CDIM264 - Introduction in Content Management',
            5 => 'FF232 - Bachelor of Writing (Hons.) Screenwriting',
            6 => 'FF233 - Bachelor of Writing (Hons.) Creative Writing',
            7 => 'FF234 - Bachelor of Theatre (Hons.) Theatre Production',
            8 => 'FF235 - Bachelor of Theatre (Hons.) Scenography',
            9 => 'FF236 - Bachelor of Creative Industry Management (Hons.) Arts Management',
            10 => 'FF237 - Bachelor of Creative Industry Management (Hons.) Film Production',
        ];

        $this->set(compact('subjects'));

    }

    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Bookings Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Bookings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $booking = $this->Bookings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
		$users = [
        1 => 'Students',
        2 => 'Lecturer',
        3 => 'UiTM Staff',
    ];

    $this->set(compact('booking', 'users'));
        $rooms = [
            1 => 'Bilik Kuliah 1',
            2 => 'Bilik Kuliah 2',
            3 => 'Bilik Kuliah 3',
            4 => 'Bilik Kuliah 4',
            5 => 'Bilik Kuliah 5',
            6 => 'Makmal Komputer 1',
            7 => 'Makmal Komputer 2',
            8 => 'Makmal Komputer 3',
            9 => 'Makmal Komputer 4',
            10 => 'Makmal Komputer 5',
            11 => 'Dewan Seminar 1',
            12 => 'Dewan Seminar 2',
        ];

        $this->set(compact('rooms'));

        $subjects = [
            1 => 'CDIM260 - Information in Library Science',
            2 => 'CDIM262 - Information in Record Management',
            3 => 'CDIM263 - Introduction in Information System',
            4 => 'CDIM264 - Introduction in Content Management',
            5 => 'FF232 - Bachelor of Writing (Hons.) Screenwriting',
            6 => 'FF233 - Bachelor of Writing (Hons.) Creative Writing',
            7 => 'FF234 - Bachelor of Theatre (Hons.) Theatre Production',
            8 => 'FF235 - Bachelor of Theatre (Hons.) Scenography',
            9 => 'FF236 - Bachelor of Creative Industry Management (Hons.) Arts Management',
            10 => 'FF237 - Bachelor of Creative Industry Management (Hons.) Film Production',
        ];

        $this->set(compact('subjects'));


    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Bookings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'Bookings Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Bookings']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $booking = $this->Bookings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
			$booking->status = 2; //archived
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been archived.'));

				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The booking could not be archived. Please, try again.'));
        }
        $this->set(compact('booking'));
    }
}
