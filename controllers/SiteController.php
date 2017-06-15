<?php

namespace app\controllers;

use app\models\News;
use app\services\NewsGenerator;
use app\services\StatsGenerator;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionGenerateNews($count = 150)
    {
        /** @var NewsGenerator $newsGenerator */
        $newsGenerator =  new NewsGenerator();
        $start = microtime(true);
        $newsGenerator->generate($count);

        return $this->render('generation-result', [
            'number' => $count,
            'duration' => microtime(true) - $start,
        ]);
    }

    public function actionView()
    {
        return $this->render('view', [
            'newsDataProvider' => new ActiveDataProvider([
                'query' => News::find()->orderBy('id desc'),
                'pagination' => [
                    'pageSize' => 100,
                ],
            ]),
        ]);
    }

    public function actionStats()
    {
        $statsGenerator = new StatsGenerator();
        $stats = $statsGenerator->generate();

        return $this->render('stats', [
            'stats' => $stats
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
