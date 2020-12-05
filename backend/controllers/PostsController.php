<?php

namespace backend\controllers;

use Yii;
use backend\models\Posts;
use backend\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create' , 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
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
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post())) {
            $model->author = Yii::$app->user->identity->id;
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                $model->image = $model->category_id . '_' . $model->title . '_' . $model->file->name;
            }

            // $model->image = UploadedFile::getInstance($model, 'image');
            // if ($model->image) {
            //     $imgName = $model->getCategory() . '_' . $model->id . '.' . $model->image->extension;
            //     $imgPath = 'frontend/web/uploads/' . $imgName;
            //     $model->image->saveAs($imgPath);
            //     $model->image = $imgPath;
            // }

            // $model->image = UploadedFile::getInstances($model, 'image');
            // if( $model->image && $model->validate()){
            //     foreach ($model->image as $images) {
            //         $file = new Attachment();
            //         $file->form_id = $model->leaveID;
            //         $file->staff_id = $model->staff_id;
            //         $file->attachment_name = $images->baseName;
            //         $file->attachment_path = $file->form_id.'_'.$images->baseName.'.'.$images->extension;
            //         if($file->save()){
            //             $images->saveAs(Yii::getAlias('@uploads/'). $file->attachment_path);
            //             }
            //         }
            //     }

            // $postsid = $model->id;
            // $categoryid = $model->getCategory();
            // $imgName = $categoryid . '_' . $postsid;
            // $model->image=UploadedFile::getInstance($model,'image');
            // $model->image->saveAs('uploads/'.$imgName.'.'.$model->image->extension);



            // $postsid = $model->id;
            // $categoryid = $model->getCategory();
            // $images = UploadedFile::getInstance($model, 'image');
            // $imgName = $categoryid . '_' . $postsid . '.' . $images->getExtension();
            // $images->saveAs(Yii::getAlias('@imgPath') . '/' . $imgName);
            // $model->image = $imgName;
            // $model->save();

            if ($model->save()) {
                if ($model->file) {
                    $model->file->saveAs(Yii::getAlias('@imgPath') . '/' . $model->image);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                $model->image = $model->category_id . '_' . $model->id . '_' . $model->file->name;
            }
            if ($model->save()) {
                if ($model->file) {
                    $model->file->saveAs(Yii::getAlias('@imgPath') . '/' .$model->image);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDeleteimage($id)
    {
        $image = Posts::find()->where(['id' => $id])->one()->image;

        if ($image) {
            if (!unlink(Yii::getAlias('@imgPath') . '/' .$image)) {
                return false;
            }
        }

        $posts = Posts::findOne($id);
        $posts->image = NULL;
        $posts->update();

        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Deletes an existing Posts model.
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

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
