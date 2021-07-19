<?php

namespace App\Http\Livewire\Google;

use Livewire\Component;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class GoogleAnalytics extends Component
{
    use WithPagination;

    //Theme
    protected $paginationTheme = 'bootstrap';

    public $pageDomain;

    public function mount(){
        $this->pageDomain = config('app.page-domain');
    }

    public function render()
    {
        //fetch visitors and page views for the past week
        $visitorAndPages = Analytics::fetchMostVisitedPages(Period::months(1))->sortByDesc('pageViews');
        $visitorAndPages = $this->paginate($visitorAndPages);

        //Total de visitantes y páginas vistas
        $totalVisitorAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::months(1));

        $referres = Analytics::fetchTopReferrers(Period::months(1));

        $browsers = Analytics::fetchTopBrowsers(Period::months(1));

        //retrieve sessions and pageviews with yearMonth dimension since 1 year ago
        $analyticsData = Analytics::performQuery(
            Period::months(1),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions, ga:pageviews',
                'dimensions' => 'ga:yearMonth'
            ]
        );

        $totalViews = 0;
        $totalUsers = 0;

        foreach($totalVisitorAndPageViews as $tvpv){
            $totalViews += $tvpv['pageViews'];
            $totalUsers += $tvpv['visitors'];
        }
        
        // dd($totalVisitorAndPageViews);
        return view('livewire.google.google-analytics', compact('visitorAndPages', 
                                                                'totalVisitorAndPageViews', 
                                                                'referres',
                                                                'analyticsData',
                                                                'browsers',
                                                                'totalViews',
                                                                'totalUsers'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
