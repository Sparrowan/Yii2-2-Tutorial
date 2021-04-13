<?php

namespace backend\controllers;

use Yii;
use backend\models\Emails;
use backend\models\Companies;
use backend\models\Branches;
use backend\models\EmailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * EmailsController implements the CRUD actions for Emails model.
 */
class EmailsController extends Controller
{
    /**
     * {@inheritdoc}
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
        ];
    }

    /**
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Emails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emails();
        $companies = ArrayHelper::map(Companies::find()->all(),'id','name');
        $branches = ArrayHelper::map(Branches::find()->all(),'id','name');

        if ($model->load(Yii::$app->request->post())) {
            // Upload the attachment
            $model->attachment = UploadedFile::getInstance($model, 'attachment');

            if ($model->attachment)
            {
                $time = time();
                $model->attachment->saveAs('attachments/'.$time. '.' .$model->attachment->extension);
                $model->attachment= 'attachments/' .$time. '.' .$model->attachment->extension;
            }

            if ($model->attachment)
            {
                $value = Yii::$app->mailer->compose()
                ->setFrom(['wambuaalphius@gmail.com'=>'Wambua Mutisya'])
                ->setTo($model->receiver_email)
                ->setSubject($model->subject)
                ->setHtmlBody($model->subject)
                ->attach($model->attachment)
                ->send();
            }
            else{
                $value = Yii::$app->mailer->compose()
                ->setFrom(['wambuaalphius@gmail.com'=>'Wambua Mutisya'])
                ->setTo($model->receiver_email)
                ->setSubject($model->subject)
                ->setHtmlBody($model->subject)
                ->send();
            }
            $model->user_id=Yii::$app->user->getId();
            
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'companies'=>$companies,
            'branches'=>$branches,
        ]);
    }

    /**
     * Updates an existing Emails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $companies = ArrayHelper::map(Companies::find()->all(),'id','name');
        $branches = ArrayHelper::map(Branches::find()->all(),'id','name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'companies'=>$companies,
            'branches'=>$branches,
        ]);
    }

    /**
     * Deletes an existing Emails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    public function actionLists() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $companies_id = $parents[0];
                $model  = new Emails();
                $out = $model->getBranchesList($companies_id); 
                // the getSubCatList function will query the database based on the
                // companies_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-companies_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output'=>$out, 'selected'=>''];
            }
        }
        
        return ['output'=>'', 'selected'=>''];
    }


    /**
     * Finds the Emails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
