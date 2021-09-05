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
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\School;
use app\models\Report;

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

    /**
     * Creates report record.
     *
     * @return string
     */
    public function actionCreate() {
	    $model = new Report();
	    if ( $model->load( Yii::$app->request->post()) ) {
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
        $publicActionIds = [ 'index', 'view', 'create' ];

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
