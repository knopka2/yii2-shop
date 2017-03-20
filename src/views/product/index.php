<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use dvizh\shop\models\ProductOption;
use dvizh\shop\models\Category;
use dvizh\shop\models\Producer;
use dvizh\shop\models\Price;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

\dvizh\shop\assets\BackendAsset::register($this);
?>
<div class="product-index">
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            'name',
            'code',
            [
                'label' => 'Остаток',
                'content' => function($model) {
                    return "<p>{$model->amount} (".($model->amount*$model->price).")</p>";
                }
            ],
            [
                'attribute' => 'images',
                'format' => 'images',
                'filter' => false,
                'content' => function ($image) {
                    if($image = $image->getImage()->getUrl('50x50')) {
                        return "<img src=\"{$image}\" class=\"thumb\" />";
                    }
                }
            ],
            [
                'label' => 'Цена',
                'value' => 'price'
            ],
            [
                'attribute' => 'available',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'available',
                    ['no' => 'Нет', 'yes' => 'Да'],
                    ['class' => 'form-control', 'prompt' => 'Наличие']
                ),
            ],
            [
                'attribute' => 'category_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Категория']
                ),
                'value' => 'category.name'
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
        ],
    ]); ?>

</div>