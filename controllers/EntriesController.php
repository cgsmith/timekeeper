<?php

namespace app\controllers;

use Yii;
use app\models\Entries;
use app\models\EntriesSearch;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;
use yii\filters\AccessControl;

/**
 * EntriesController implements the CRUD actions for Entries model.
 */
class EntriesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actionReport()
    {
        $begin_date = date('Y-m-d', strtotime('last sunday'));
        $end_date = date('Y-m-d', strtotime('this saturday'));
        $searchModel = new EntriesSearch([
            'begin_date' => $begin_date,
            'end_date' => $end_date
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider]
        );
    }

    /**
     * Lists all Entries models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->isAdmin) {
            $searchModel = new EntriesSearch();
        } else {
            $searchModel = new EntriesSearch(['user_id'=>Yii::$app->user->id]);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entries model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Entries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Entries();
        $model->setAttribute('user_id', Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post())) {
            $model->date_created = new Expression('CURRENT_TIMESTAMP()');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Entries model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date_modified = new Expression('CURRENT_TIMESTAMP()');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Entries model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Entries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entries::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
