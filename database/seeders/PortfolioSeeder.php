<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // ── Portfolio Projects ──────────────────────────────────────────
        $projects = [
            [
                'title'         => 'Smart Agriculture Disease Detection',
                'description'   => 'CNN-based mobile app that detects plant diseases from leaf images with 95% accuracy. Deployed as Android APK using TensorFlow Lite.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=600&h=400&fit=crop',
                'tags'          => ['TensorFlow', 'CNN', 'Python', 'Android', 'TFLite'],
                'github_url'    => 'https://github.com/zhraanf',
                'demo_url'      => null,
                'type'          => 'project',
                'order'         => 1,
                'is_featured'   => true,
            ],
            [
                'title'         => 'Customer Churn Prediction Pipeline',
                'description'   => 'End-to-end MLOps pipeline using Apache Spark, Scikit-learn, and Power BI. Processes 500K+ records daily with 88% prediction accuracy.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
                'tags'          => ['Python', 'Spark', 'Scikit-learn', 'Power BI', 'SQL'],
                'github_url'    => 'https://github.com/zhraanf',
                'demo_url'      => null,
                'type'          => 'project',
                'order'         => 2,
                'is_featured'   => false,
            ],
            [
                'title'         => 'NLP Product Recommendation Engine',
                'description'   => 'HuggingFace Transformers-powered recommendation system for e-commerce. Reduced inference latency by 40% via TensorRT optimization.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=600&h=400&fit=crop',
                'tags'          => ['HuggingFace', 'PyTorch', 'TensorRT', 'NLP', 'FastAPI'],
                'github_url'    => 'https://github.com/zhraanf',
                'demo_url'      => null,
                'type'          => 'project',
                'order'         => 3,
                'is_featured'   => false,
            ],
            [
                'title'         => 'Interactive Sales Analytics Dashboard',
                'description'   => 'Real-time Power BI dashboard connected to PostgreSQL. Features drill-down analysis, KPI cards, and automated email reports for management.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop',
                'tags'          => ['Power BI', 'DAX', 'PostgreSQL', 'Python', 'Pandas'],
                'github_url'    => null,
                'demo_url'      => null,
                'type'          => 'project',
                'order'         => 4,
                'is_featured'   => false,
            ],
            [
                'title'         => 'LangChain RAG Chatbot',
                'description'   => 'Retrieval-Augmented Generation chatbot for document Q&A using LangChain, OpenAI GPT-4, and Pinecone vector database.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1676299081847-824916de030a?w=600&h=400&fit=crop',
                'tags'          => ['LangChain', 'GPT-4', 'Pinecone', 'Python', 'FastAPI'],
                'github_url'    => 'https://github.com/zhraanf',
                'demo_url'      => null,
                'type'          => 'project',
                'order'         => 5,
                'is_featured'   => false,
            ],
            [
                'title'         => 'Indonesian Twitter Sentiment Analysis',
                'description'   => 'Multi-class sentiment classifier for Indonesian tweets using IndoBERT. Achieves 91% F1-score on political discourse dataset.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1611605698335-8b1569810432?w=600&h=400&fit=crop',
                'tags'          => ['BERT', 'NLP', 'Python', 'Streamlit', 'Hugging Face'],
                'github_url'    => 'https://github.com/zhraanf',
                'demo_url'      => null,
                'type'          => 'project',
                'order'         => 6,
                'is_featured'   => false,
            ],
        ];

        foreach ($projects as $p) {
            Portfolio::create($p);
        }

        // ── Certifications ──────────────────────────────────────────────
        $certifications = [
            [
                'title'         => 'TensorFlow Developer Certificate',
                'description'   => 'Official Google TensorFlow Developer Certification demonstrating proficiency in building and training neural networks with TensorFlow.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1633356122102-3fe601e05bd2?w=600&h=400&fit=crop',
                'tags'          => ['TensorFlow', 'Deep Learning', 'Google'],
                'type'          => 'certification',
                'issuer'        => 'Google',
                'issued_date'   => '2024-11-15',
                'cert_url'      => null,
                'order'         => 1,
                'is_featured'   => true,
            ],
            [
                'title'         => 'AWS Certified Machine Learning – Specialty',
                'description'   => 'Validates expertise in building, training, tuning, and deploying ML models using AWS services.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&h=400&fit=crop',
                'tags'          => ['AWS', 'SageMaker', 'Cloud ML'],
                'type'          => 'certification',
                'issuer'        => 'Amazon Web Services',
                'issued_date'   => '2024-09-01',
                'cert_url'      => null,
                'order'         => 2,
                'is_featured'   => false,
            ],
            [
                'title'         => 'Google Data Analytics Professional Certificate',
                'description'   => 'Coursera professional certificate covering data analysis, visualization, SQL, R, and communication of data insights.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?w=600&h=400&fit=crop',
                'tags'          => ['SQL', 'R', 'Tableau', 'Google'],
                'type'          => 'certification',
                'issuer'        => 'Google / Coursera',
                'issued_date'   => '2024-06-20',
                'cert_url'      => null,
                'order'         => 3,
                'is_featured'   => false,
            ],
            [
                'title'         => 'DeepLearning.AI Deep Learning Specialization',
                'description'   => 'Five-course specialization by Andrew Ng covering neural networks, CNNs, RNNs, and practical ML projects.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=600&h=400&fit=crop',
                'tags'          => ['Deep Learning', 'Python', 'Andrew Ng'],
                'type'          => 'certification',
                'issuer'        => 'DeepLearning.AI / Coursera',
                'issued_date'   => '2024-03-10',
                'cert_url'      => null,
                'order'         => 4,
                'is_featured'   => false,
            ],
            [
                'title'         => 'Bangkit Academy 2024 — Machine Learning Path',
                'description'   => 'Distinction graduate of the Google-led intensive bootcamp. Top 10% cohort, capstone project awarded as best in class.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop',
                'tags'          => ['Bangkit', 'Google', 'ML', 'TensorFlow'],
                'type'          => 'certification',
                'issuer'        => 'Bangkit Academy (Google, GoTo, Traveloka)',
                'issued_date'   => '2024-12-31',
                'cert_url'      => null,
                'order'         => 5,
                'is_featured'   => false,
            ],
            [
                'title'         => 'IBM Data Science Professional Certificate',
                'description'   => 'Comprehensive 10-course program covering Python, SQL, data visualization, machine learning, and capstone project.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1537432376769-00f5c2f4c8d2?w=600&h=400&fit=crop',
                'tags'          => ['IBM', 'Python', 'Data Science', 'Coursera'],
                'type'          => 'certification',
                'issuer'        => 'IBM / Coursera',
                'issued_date'   => '2023-12-01',
                'cert_url'      => null,
                'order'         => 6,
                'is_featured'   => false,
            ],
        ];

        foreach ($certifications as $c) {
            Portfolio::create($c);
        }
    }
}
