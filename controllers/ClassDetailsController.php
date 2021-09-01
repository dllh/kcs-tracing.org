<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\School;
use app\models\ClassDetail;

class ClassDetailsController extends Controller
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

	public function actionIndex() {
		return $this->render( 'index' );
	}

	public function actionView( $id ) {
		$model = ClassDetail::findOne( $id );
		if ( $model === null ) {
			throw new NotFoundHttpException;
		}
		return $this->render( 'view', [
			'model' => $model,
		] );
	}

	public function actionCreate() {
		$model = new ClassDetail();
		if ( $model->load( Yii::$app->request->post()) && $model->save()) {
			return $this->redirect( [ 'class-detail/view', 'id' => $model->id ] );
		} else {
			return $this->render( 'save', [ 'model' => $model ] ); 
		}
	}

	public function actionEdit( $id ) {
		$model = ClassDetail::findOne( $id );
		if ( $model === null ) {
			throw new NotFoundException;
		}

		if ( $model->load( Yii::$app->request->post()) && $model->save()) {
			return $this->redirect( [ 'class-detail/view', 'id' => $model->id ] );
		} else {
			return $this->render( 'save', [ 'model' => $model ] );
		}
	}

	
	public function beforeAction( $action ) {
		$isGuest = Yii::$app->user->isGuest;

		// List of actions that are available to guests.
		$publicActionIds = [ 'index', 'view' ];

		// Always return true for logged-in users.
		if ( ! $isGuest ) {
			return true;
		}

		if ( $isGuest ) {
			if ( ! in_array( $action->id, $publicActionIds ) ) {
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
