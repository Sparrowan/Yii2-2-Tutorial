<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            
            [
                'header' => 'ID',
                'attribute' => 'id',
            ],
            [
                'header' => 'Company Name',
                'attribute' => 'companies_id',
                'value' => 'companies.name',
            ],
            [
                'header' => 'Branch Name',
                'attribute' => 'branches_id',
                'value' => 'branches.name',
            ],
            [
                'header' => 'Department Name',
                'attribute' => 'name',
            ],
            [
                'header' => 'Created At',
                'attribute' => 'created_at',
            ],
            [
                'header' => 'Status',
                'attribute' => 'status',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
