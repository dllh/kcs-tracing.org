<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\School;
use app\models\Exposure;

class SchoolsController extends Controller
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
     * Displays schools page.
     *
     * @return string
     */
    public function actionIndex() {
	    return $this->render( 'index' );
    }

    /**
     * Displays single school page.
     *
     * @return string
     */
    public function actionView( $id ) {
	    $model = School::findOne( $id );
	    if ( $model === null ) {
		throw new NotFoundHttpException;
	    }
	    return $this->render( 'view', [
		    'model' => $model,
	    ] );
    }

    /**
     * Creates school record.
     *
     * @return string
     */
    public function actionCreate() {
	    $model = new School();
	    if ( $model->load( Yii::$app->request->post()) && $model->save()) {
		    return $this->redirect( [ 'schools/view', 'id' => $model->id ] );
	    } else {
		    return $this->render( 'save', [ 'model' => $model ] ); 
	    }
    }

    /**
     * Edits school record.
     *
     */
    public function actionEdit( $id ) {
	    $model = School::findOne( $id );
	    if ( $model === null ) {
		throw new NotFoundException;
	    }
	    
	    if ( $model->load( Yii::$app->request->post()) && $model->save()) {
		    return $this->redirect( [ 'schools/view', 'id' => $model->id ] );
	    } else {
		    return $this->render( 'save', [ 'model' => $model ] ); 
	    }
    }

}
