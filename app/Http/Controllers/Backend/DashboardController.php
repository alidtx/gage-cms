<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Entity;
use App\Models\News;
use App\Models\PageContent;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'stats' => [
                'pages' => PageContent::count(),
                'entities' => Entity::where('is_active', true)->count(),
                'news' => News::where('status', 'published')->count(),
                'messages' => ContactSubmission::count(),
            ],
            'recentMessages' => ContactSubmission::latest('id')->limit(5)->get(['id', 'full_name', 'subject', 'created_at']),
            'latestNews' => News::with('category:id,name')->latest('id')->limit(5)->get(['id', 'title', 'status', 'news_category_id']),
            'recentPages' => PageContent::orderByDesc('updated_at')->orderByDesc('id')->limit(5)->get(['id', 'name', 'page', 'updated_at']),
        ]);
    }
}
