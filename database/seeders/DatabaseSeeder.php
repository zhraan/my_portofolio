<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Profile
        Profile::create([
            'name' => 'Zahran Fikri',
            'taglines' => [
                'Data Scientist',
                'Data Engineer',
                'AI Engineer',
                'ML Engineer',
                'Data Analyst',
                'Data Enthusiast',
                'Data-Driven Developer',
                'BI Analyst',
            ],
            'bio' => 'A Data Professional specializing in building end-to-end data pipelines, machine learning models, and actionable analytics dashboards. I transform raw data into strategic insights that drive business decisions.',
            'photo_url' => '/img/img1.jpeg',
            'cv_url' => '#',
            'social_links' => [
                'github' => 'https://github.com/zhraanf',
                'linkedin' => 'https://linkedin.com/in/zhraanf',
                'twitter' => 'https://twitter.com/zhraanf',
            ],
        ]);

        // Skills - Row 1: Data Science & Visualization
        $row1 = ['Python', 'Pandas', 'NumPy', 'Matplotlib', 'Plotly', 'Seaborn', 'R'];
        $row1Icons = [
            'devicon-python-plain colored', 'devicon-pandas-plain colored', 'devicon-numpy-plain colored',
            'devicon-matplotlib-plain colored', 'devicon-plotly-plain colored', 'devicon-r-plain colored', 'devicon-r-plain colored',
        ];
        foreach ($row1 as $i => $name) {
            Skill::create([
                'name' => $name,
                'icon_class' => $row1Icons[$i] ?? 'devicon-devicon-plain',
                'category' => 'Data Science',
                'row_number' => 1,
                'order' => $i,
            ]);
        }

        // Skills - Row 2: AI/ML Frameworks
        $row2 = ['TensorFlow', 'Keras', 'Scikit-learn', 'HuggingFace', 'LangChain', 'PyTorch'];
        $row2Icons = [
            'devicon-tensorflow-original colored', 'devicon-keras-plain colored', 'devicon-scikitlearn-plain colored',
            'devicon-python-plain colored', 'devicon-python-plain colored', 'devicon-pytorch-original colored',
        ];
        foreach ($row2 as $i => $name) {
            Skill::create([
                'name' => $name,
                'icon_class' => $row2Icons[$i] ?? 'devicon-devicon-plain',
                'category' => 'AI/ML',
                'row_number' => 2,
                'order' => $i,
            ]);
        }

        // Skills - Row 3: Data Engineering & BI
        $row3 = ['Power BI', 'Tableau', 'Looker', 'Microsoft Fabric', 'Excel', 'Apache Spark', 'Airflow', 'dbt', 'PostgreSQL', 'BigQuery'];
        $row3Icons = [
            'devicon-devicon-plain colored', 'devicon-devicon-plain colored', 'devicon-google-plain colored',
            'devicon-azure-plain colored', 'devicon-devicon-plain colored', 'devicon-apachespark-original colored',
            'devicon-apacheairflow-plain colored', 'devicon-devicon-plain colored', 'devicon-postgresql-plain colored', 'devicon-googlecloud-plain colored',
        ];
        foreach ($row3 as $i => $name) {
            Skill::create([
                'name' => $name,
                'icon_class' => $row3Icons[$i] ?? 'devicon-devicon-plain',
                'category' => 'Data Engineering',
                'row_number' => 3,
                'order' => $i,
            ]);
        }
    }
}
