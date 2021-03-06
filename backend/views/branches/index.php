<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Branches', ['value'=>Url::to('index.php?r=branches/create'),'class' => 'btn btn-success','id'=>'modalButtonCreate']) ?>
    </p>

    <?php 
        Modal::begin([
            // 'header' => '<h2>Hello world</h2>',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
        
        echo "<div id='modalContent'></div>";
    
    Modal::end();
    
    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if($model->status == 'inactive')
            {
                return['class'=>'danger'];
            }
            else
            {
                return['class'=>'success'];
            }
        },
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
