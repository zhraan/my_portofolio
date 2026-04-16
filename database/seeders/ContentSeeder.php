<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareerEntry;
use App\Models\Activity;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // ── Career Entries (dummy data) ──────────────────────────────
        CareerEntry::create([
            'company'     => 'PT Telkom Indonesia',
            'position'    => 'Data Science Intern',
            'type'        => 'internship',
            'start_date'  => '2025-06-01',
            'end_date'    => '2025-09-30',
            'description' => [
                'Built end-to-end customer churn prediction pipeline using Python & Scikit-learn',
                'Developed interactive Power BI dashboards for senior management reporting',
                'Processed 500K+ records daily using Apache Spark and PostgreSQL',
            ],
            'logo_url'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Logo_Telkom_Indonesia_2021.svg/400px-Logo_Telkom_Indonesia_2021.svg.png',
            'media_urls'  => null,
            'order'       => 1,
        ]);

        CareerEntry::create([
            'company'     => 'Tokopedia (GoTo)',
            'position'    => 'Machine Learning Engineer Intern',
            'type'        => 'internship',
            'start_date'  => '2025-01-15',
            'end_date'    => '2025-05-15',
            'description' => [
                'Implemented NLP-based product recommendation engine using HuggingFace Transformers',
                'Reduced model inference latency by 40% through TensorRT optimization',
                'Collaborated with cross-functional teams on A/B testing frameworks',
            ],
            'logo_url'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_Tokopedia.svg/400px-Logo_Tokopedia.svg.png',
            'media_urls'  => null,
            'order'       => 2,
        ]);

        CareerEntry::create([
            'company'     => 'Bangkit Academy by Google',
            'position'    => 'Machine Learning Path Student',
            'type'        => 'full-time',
            'start_date'  => '2024-08-01',
            'end_date'    => '2024-12-31',
            'description' => [
                'Completed comprehensive ML curriculum covering TensorFlow, Keras, and deployment',
                'Built capstone project: Smart Agriculture Disease Detection using CNN (95% accuracy)',
                'Received distinction as top 10% cohort graduate',
            ],
            'logo_url'    => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/400px-Google_2015_logo.svg.png',
            'media_urls'  => null,
            'order'       => 3,
        ]);

        // ── Activities (Bootcamp Data di Indonesia) ──────────────────
        Activity::create([
            'title'         => 'Bangkit Academy 2024 — Machine Learning Path',
            'category'      => 'Bootcamp',
            'description'   => 'Intensive 5-month bootcamp by Google, GoTo, and Traveloka focused on Machine Learning, Deep Learning, and TensorFlow Deployment. Completed 150+ hours of structured learning with industry-grade capstone project.',
            'thumbnail_url' => null,
            'link_url'      => 'https://grow.google/intl/id_id/bangkit/',
            'published_at'  => '2024-12-31',
        ]);

        Activity::create([
            'title'         => 'DQLab Data Analyst Bootcamp',
            'category'      => 'Bootcamp',
            'description'   => 'Comprehensive data analytics bootcamp covering Python, SQL, statistics, and data visualization using real-world Indonesian company datasets. Earned professional certificate upon completion.',
            'thumbnail_url' => null,
            'link_url'      => 'https://dqlab.id',
            'published_at'  => '2024-09-15',
        ]);

        Activity::create([
            'title'         => 'Dicoding Indonesia — Belajar Machine Learning untuk Pemula',
            'category'      => 'Bootcamp',
            'description'   => 'Self-paced bootcamp by Dicoding covering fundamentals of Machine Learning with Python, Scikit-learn, and TensorFlow. Includes hands-on projects and industry-recognized certification.',
            'thumbnail_url' => null,
            'link_url'      => 'https://dicoding.com',
            'published_at'  => '2024-07-20',
        ]);

        Activity::create([
            'title'         => 'Hacktiv8 — Data Science Bootcamp',
            'category'      => 'Bootcamp',
            'description'   => 'Intensive full-stack data science bootcamp covering statistics, machine learning, deep learning, and deploying ML models to production. Collaborated on team capstone with real business cases.',
            'thumbnail_url' => null,
            'link_url'      => 'https://hacktiv8.com',
            'published_at'  => '2024-05-01',
        ]);

        Activity::create([
            'title'         => 'Startup Campus — AI Track Bootcamp',
            'category'      => 'Bootcamp',
            'description'   => 'Part of Kampus Merdeka program. Focused on Artificial Intelligence applications in industry, including computer vision, NLP, and reinforcement learning with mentorship from industry professionals.',
            'thumbnail_url' => null,
            'link_url'      => 'https://startupcampus.id',
            'published_at'  => '2024-03-15',
        ]);

        Activity::create([
            'title'         => 'MySkill Data Analytics Intensive Bootcamp',
            'category'      => 'Bootcamp',
            'description'   => 'Fast-paced bootcamp focusing on SQL, Python for data analysis, Tableau dashboards, and Google Data Studio. Includes real project portfolio building for job readiness.',
            'thumbnail_url' => null,
            'link_url'      => 'https://myskill.id',
            'published_at'  => '2024-01-10',
        ]);
    }
}
