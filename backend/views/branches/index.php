<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Branches', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'companies.name',
            // 'name',
            // 'address',
            // 'created_at',
            // //'status',

            [
                'header' => 'Company Name',
                'attribute' => 'companies_id',
                'value' => 'companies.name',
            ],
            [
                'header' => 'Name',
                'attribute' => 'name',
                'value' => 'name',
            ],
            [
                'header' => 'Address',
                'attribute' => 'address',
                'value' => 'address',
            ],
            [
                'header' => 'Created At',
                'attribute' => 'created_at',
                'value' => 'created_at',
            ],
            [
                'header' => 'Status',
                'attribute' => 'status',
                'value' => 'status',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
