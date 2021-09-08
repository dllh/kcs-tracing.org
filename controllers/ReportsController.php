<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Request;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\DynamicModel;
use yii\db\Query;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\School;
use app\models\Report;
use app\models\Search;

class ReportsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays reports page.
     *
     * @return string
     */
    public function actionIndex() {
	    return $this->render( 'index' );
    }

    /**
     * Displays single report page.
     *
     * @return string
     */
    public function actionView( $id ) {
	    $model = Report::findOne( $id );
	    if ( $model === null ) {
		throw new NotFoundHttpException;
	    }
	    return $this->render( 'view', [
		    'model' => $model,
	    ] );
    }

	public function validateCode( $attribute, $params ) {
		$query = new Query;
		
		$row = $query->select( [ 'id', 'code', 'used' ] )
		    		->from( 'one_time_codes' )
				->where( 'code = "' . $_post['OneTimeCode']['code'] . '"' )
				->one();

		if ( false === $row ) {
			$model->addError( 'The code you have provided is not valid.' );
			error_log( "NO ROW FOUND\n" );
		} else {
			error_log( "ROW " . print_r( $row, true ) . " ROW\n");
		}
        }

    /**
     * Creates report record.
     *
     * @return string
     */
    public function actionCreate() {
	    $model = new Report();
	    $post = Yii::$app->request->post();
	    if ( $model->load( $post ) ) {
		    if ( $model->save() ) {
		    	Yii::$app->session->setFlash( 'success', "Report successfully created!" );
		    	return $this->redirect( [ 'reports/view', 'id' => $model->id, 'saved' => 1 ] );
		    } else {
		    	Yii::$app->session->setFlash( 'error', "Could not save record." );
		    	return $this->render( 'save', [ 'model' => $model, 'id' => $model->id ] ); 
		    }
	    } else {
		    return $this->render( 'save', [ 'model' => $model, 'id' => $model->id ] ); 
	    }
    }

    /**
     * Searches reports.
     *
     * @return string
     */
    public function actionSearch() {
	    $searchModel = new Search();

	    $dataProvider = $searchModel->search( Yii::$app->request->get(), [
		    'pagination' => [ 'pageSize' => 25,  ],
		    'sort'       => [
			    'defaultOrder' => [
				    'positive_test_date' => SORT_DESC, // Not really sure about this, but I do need a default.
			    ],
		    ],
	    ] );
	    return $this->render( 'search', [
		    'dataProvider' => $dataProvider,
		    'searchModel'  => $searchModel,
		    'hasSearch'    => ! empty( Yii::$app->request->get() ), // Determines whether we show the results grid or not.
	    ]);
    }

    /**
     * Edits report record.
     *
     */
    public function actionEdit( $id ) {
	    $model = Report::findOne( $id );
	    if ( $model === null ) {
		throw new NotFoundException;
	    }
	    
	    if ( $model->load( Yii::$app->request->post()) && $model->save()) {
		    return $this->redirect( [ 'reports/view', 'id' => $model->id ] );
	    } else {
		    return $this->render( 'save', [ 'model' => $model ] ); 
	    }
    }


    public function beforeAction( $action ) {

        $isGuest = Yii::$app->user->isGuest;

	// List of actions that are available to guests.
	// The 'create' action here is intentional, as we do want public reports.
        $publicActionIds = [ 'index', 'view', 'create', 'search' ];

        // Always return true for logged-in users.
        if ( ! $isGuest ) {
                return true;
        }

        //print( '<pre>' . print_r( $action, true ) . '</pre>' ); exit;
        if ( $isGuest ) {
                if ( ! in_array( $action->id, $publicActionIds ) ) {
                        //return false;
                        throw new NotFoundHttpException('Not found');
                }
        }

        // If the parent function returns false, return false.
        if ( ! parent::beforeAction( $action ) ) {
                return false;
        }

        // If nothing else causes us to bail early, return true.
        return true;
    }

}
