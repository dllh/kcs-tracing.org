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

class ExposuresController extends Controller
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
	 * Displays exposures page.
	 *
	 * @return string
	 */
	public function actionIndex() {
		return $this->render( 'index' );
	}

	/**
	 * Displays single exposure page.
	 *
	 * @return string
	 */
	public function actionView( $id ) {
		$model = Exposure::findOne( $id );
		if ( $model === null ) {
			throw new NotFoundHttpException;
		}
		return $this->render( 'view', [
			'model' => $model,
		] );
	}

	/**
	 * Creates exposure record.
	 *
	 * @return string
	 */
	public function actionCreate() {
		$model = new Exposure();
		if ( $model->load( Yii::$app->request->post()) && $model->save()) {
			return $this->redirect( [ 'exposures/view', 'id' => $model->id ] );
		} else {
			return $this->render( 'save', [ 'model' => $model ] ); 
		}
	}

	/**
	 * Edits exposure record.
	 *
	 */
	public function actionEdit( $id ) {
		$model = Exposure::findOne( $id );
		if ( $model === null ) {
			throw new NotFoundException;
		}

		if ( $model->load( Yii::$app->request->post()) && $model->save()) {
			return $this->redirect( [ 'exposures/view', 'id' => $model->id ] );
		} else {
			return $this->render( 'save', [ 'model' => $model ] );
		}
	}
}
