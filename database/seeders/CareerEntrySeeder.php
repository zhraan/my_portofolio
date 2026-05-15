<?php

namespace Database\Seeders;

use App\Models\CareerEntry;
use Illuminate\Database\Seeder;

class CareerEntrySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing entries
        CareerEntry::truncate();

        $entries = [
            // 1. IDS Cyber Security Academy
            [
                'company'       => 'IDS | BTEC',
                'position'      => 'Cyber Security Academy - Junior Pentester Student',
                'type'          => 'seasonal',
                'start_date'    => '2026-03-01',
                'end_date'      => null,
                'location'      => 'Jakarta Selatan, Indonesia · Remote',
                'description'   => [
                    'Currently enrolled in the IDS Cyber Security Academy — Offensive Web Security Bootcamp at IDS | BTEC, a structured program focused on mastering web exploitation techniques and offensive security practices from the ground up. Pursuing this program alongside primary development in the data field, driven by a strong interest in understanding how systems are attacked in order to build more secure and resilient solutions.',
                    'Areas of study include Web Application Penetration Testing, Network Penetration Testing, Vulnerability Assessment, and Red Team concepts, with hands-on practice through Capture The Flag (CTF) challenges and practical labs using Kali Linux as the primary operating system. Complementing bootcamp learning with self-directed study on TryHackMe to continuously sharpen offensive security skills.',
                    'Motivated by the belief that cybersecurity knowledge — particularly in identifying and exploiting vulnerabilities — is a critical complement to data expertise, enabling the development of solutions that are not only insightful but also secure and trustworthy.',
                ],
                'skills'        => ['Penetration Testing', 'Ethical Hacking', 'Secure Data Practices', 'Vulnerability Assessment', 'Red Team Operations'],
                'logo_url'      => 'https://media.licdn.com/dms/image/v2/D560BAQHWo36e0edJog/company-logo_200_200/B56ZaFU0DZGoAI-/0/1745993548567/ids_btec_logo?e=2147483647&v=beta&t=J7-hRll8oNm6w_a_UfijEzne4OuedwKDVtSG-cNuMYA',
                'media_urls'    => null,
                'order'         => 1,
            ],

            // 2. ID/X Partners x Rakamin Academy
            [
                'company'       => 'ID/X Partners',
                'position'      => 'Project-Based Virtual Intern: Data Scientist',
                'type'          => 'internship',
                'start_date'    => '2026-03-01',
                'end_date'      => '2026-04-30',
                'location'      => 'Area DKI Jakarta · Remote',
                'description'   => [
                    'Completed a Project-Based Virtual Internship as Data Scientist in collaboration between ID/X Partners and Rakamin Academy, executed fully remotely. ID/X Partners is a leading Indonesian data analytics and decisioning consultancy serving over 85 financial institutions across banking, multifinance, fintech, and insurance sectors.',
                    'Developed an end-to-end Machine Learning solution for credit risk prediction using historical loan data (2007–2014) from a dataset comprising 466,285 records and 75 initial features. The project aimed to classify borrowers into two categories — Good Loan and Bad Loan — to improve credit assessment accuracy, optimize loan approval decisions, and reduce potential losses from non-performing loans.',
                    'Executed the full data science lifecycle including Data Understanding, Exploratory Data Analysis (EDA), Data Preparation, Modeling, and Evaluation. Conducted univariate and bivariate analysis to identify key patterns, handled missing values across 40 columns, performed feature selection reducing features from 76 to 34, applied IQR-based outlier capping, and implemented Label Encoding for categorical variables.',
                    'Built and compared two classification models using Python and Scikit-learn — Logistic Regression and Random Forest Classifier — evaluating performance across Accuracy, Precision, Recall, F1-Score, and ROC-AUC metrics. Random Forest outperformed Logistic Regression with an accuracy of 83.96%, F1-Score of 0.91, and mean cross-validation accuracy of 84.35%.',
                ],
                'skills'        => ['Problem Solving', 'Critical Thinking', 'Statistical Analysis', 'Data Scientist', 'Data Wrangling', 'Exploratory Data Analysis (EDA)', 'Data Cleaning', 'Data Visualization', 'Data Modelling', 'Machine Learning'],
                'logo_url'      => 'https://media.licdn.com/dms/image/v2/C4E0BAQEhAsvQMP7jvA/company-logo_200_200/company-logo_200_200/0/1631338564976?e=2147483647&v=beta&t=0icz4ZfPeUYIY4DMFQDMb2esBRVs5F6IM2-qRFNIFNo',
                'media_urls'    => ['/img/Certificate IDX Partner Data Scientist.png'],
                'order'         => 2,
            ],

            // 3. LKJ — R&D Coordinator
            [
                'company'       => 'Laboratorium Komputer dan Jaringan (LKJ)',
                'position'      => 'Research and Development Coordinator of Network Division',
                'type'          => 'part-time',
                'start_date'    => '2024-08-01',
                'end_date'      => '2025-09-30',
                'location'      => 'Padang, Sumatera Barat, Indonesia · On-site',
                'description'   => [
                    'Conducting the design and delivery of comprehensive training programs in Python programming and network fundamentals for 20 staff members, achieving a 95% material completion rate and demonstrating strong instructional effectiveness.',
                    'Led Mikrotik configuration training initiatives that resulted in a 78% improvement in staff technical competency, contributing to an overall elevation of the laboratory\'s operational capability.',
                    'Developed and deployed a web-based laboratory platform as part of a digitalization initiative, successfully digitizing practicum modules and administrative correspondence processes — reducing student data access time by up to 70% and significantly improving operational efficiency.',
                ],
                'skills'        => ['Network Configuration', 'Project Management', 'Troubleshooting', 'Training & Development', 'Teamwork'],
                'logo_url'      => 'https://media.licdn.com/dms/image/v2/D560BAQGSgsKhymDo7g/company-logo_100_100/company-logo_100_100/0/1733135915361?e=1778716800&v=beta&t=Fm2P1rnwJAWFLMNgR576zwTgm1TzdMK-srnB-o672VI',
                'media_urls'    => ['/img/MTCNA Certificate.png', '/img/Research and Development Staff.png', '/img/Research and Development Staff 2.png'],
                'order'         => 3,
            ],

            // 4. LKJ — Laboratory Assistant
            [
                'company'       => 'Laboratorium Komputer dan Jaringan (LKJ)',
                'position'      => 'Laboratory Assistant',
                'type'          => 'part-time',
                'start_date'    => '2023-11-01',
                'end_date'      => '2025-09-30',
                'location'      => 'Padang, Sumatera Barat, Indonesia · On-site',
                'description'   => [
                    'Assisted in the delivery of practical laboratory sessions for undergraduate students in Computer Engineering, covering Python programming and computer networking with Mikrotik configuration.',
                    'Developed and managed practicum modules to ensure structured and up-to-date learning materials aligned with course objectives. Provided technical guidance and hands-on mentoring to students during lab sessions, supporting comprehension of both theoretical concepts and practical implementation.',
                    'Responsible for the configuration, maintenance, and management of laboratory equipment and network infrastructure to ensure optimal learning environment. Contributed to the digitalization of lab administration through the development of a web-based laboratory platform.',
                ],
                'skills'        => ['Project Management', 'Troubleshooting', 'Network Configuration', 'Teamwork', 'Training & Development'],
                'logo_url'      => 'https://media.licdn.com/dms/image/v2/D560BAQGSgsKhymDo7g/company-logo_100_100/company-logo_100_100/0/1733135915361?e=1778716800&v=beta&t=Fm2P1rnwJAWFLMNgR576zwTgm1TzdMK-srnB-o672VI',
                'media_urls'    => ['/img/Laboratory Assistant LKJ.png', '/img/Laboratory Assistant LKJ 2.png'],
                'order'         => 4,
            ],

            // 5. Bangkit Academy
            [
                'company'       => 'Bangkit led by Google, Goto, and Traveloka',
                'position'      => 'Machine Learning Cohort',
                'type'          => 'internship',
                'start_date'    => '2024-02-01',
                'end_date'      => '2024-07-31',
                'location'      => 'Remote',
                'description'   => [
                    'As a Machine Learning student at Bangkit Academy, completed a rigorous 958-hour curriculum designed to bridge the gap between academic theory and industry-standard AI application. Trained in advanced technical competencies and professional development, successfully graduating from the Machine Learning path with a strong academic record.',
                    'Mastered end-to-end ML workflows, including data preprocessing, model building, and optimization using TensorFlow. Completed specialized training in Deep Learning and TensorFlow Data/Deployment strategies. Applied advanced mathematics for Machine Learning and Data Science to develop robust algorithmic solutions.',
                    'Collaborated within a cross-functional team to design and execute a comprehensive final project, achieving a high distinction (Grade A). Completed 240+ hours of professional training focused on critical thinking, time management, professional communication, and leadership.',
                    'Graduated as a Full Graduate with a final GPA-equivalent score of 89.06 (Grade A). Maintained a 100% attendance record for all mandatory and optional sessions. Led the technical development for Capstone Team, delivering a finished AI solution with an A grade.',
                ],
                'skills'        => ['Machine Learning', 'Problem Solving', 'Statistical Analysis', 'Critical Thinking', 'Reporting & Presentation', 'Project Management', 'Data Analysis', 'Teamwork', 'Exploratory Data Analysis (EDA)'],
                'logo_url'      => 'https://media.licdn.com/dms/image/v2/D560BAQGVomgVddrtBA/company-logo_200_200/B56ZWOrFbWGUAM-/0/1741855415072/bangkit_academy_logo?e=2147483647&v=beta&t=oWNWz9O6b8rrBzaHIYm0P8JDa0hYPcNOJcPJMa_jpcY',
                'media_urls'    => ['/img/Certificate - M184D4KY1766.png', '/img/Certificate 2- M184D4KY1766.png', '/img/Final Transcript - M184D4KY1766.png', '/img/Graduation Letter - M184D4KY1766.png', '/img/Capstone Project.png'],
                'order'         => 5,
            ],

            // 6. PT Semen Indonesia (SIG)
            [
                'company'       => 'PT Semen Indonesia (Persero) Tbk',
                'position'      => 'Software Engineer & IT Support Intern',
                'type'          => 'internship',
                'start_date'    => '2024-01-01',
                'end_date'      => '2024-02-28',
                'location'      => 'Padang, Sumatera Barat, Indonesia · On-site',
                'description'   => [
                    'Completed a Software Engineer internship at PT Semen Indonesia (Persero) Tbk, assigned to the central ICT office of Semen Indonesia Group in Padang, West Sumatra. Gained firsthand experience working in a corporate technology environment within one of Indonesia\'s largest state-owned cement manufacturers.',
                    'Tasked with independently designing and developing a web-based CRUD application to digitize the recording and reporting of operational error codes across the company\'s operational units. Prior to this solution, error code data was manually recorded and accessed through Excel spreadsheets.',
                    'Handled the full development lifecycle of the application — from requirements analysis and system design to front-end development, back-end logic, and database integration. Built the application using HTML, CSS, and JavaScript for the user interface, PHP for server-side processing, and MySQL as the relational database management system. Delivered a fully functional web application within 2–3 weeks.',
                    'Beyond software development, also participated in IT asset inspection and contributed to IT support services, gaining broader exposure to day-to-day ICT operations within a large corporate environment.',
                ],
                'skills'        => ['Problem Solving', 'Critical Thinking', 'Reporting & Presentation', 'Software Development', 'Web Development'],
                'logo_url'      => 'https://www.sig.id/storage/misc/logo-sig.jpg',
                'media_urls'    => ['/img/Certificate - SIG.png', '/img/(PMC) Preventive Maintenance IT Infrastructure.png', '/img/(PMC) Preventive Maintenance IT Infrastructure 2.png', '/img/Recording and Labeling of Company IT Assets.png', '/img/Web development of operational error code documentation.png', '/img/Dashboard - Web.png', '/img/Export Data Feature - Web.png', '/img/Filter Data Base on Input Date - Web.png', '/img/Filter Data Base on Update Date - Web.png'],
                'order'         => 6,
            ],

            // 7. Al-Fatih Media Center
            [
                'company'       => 'Al-Fatih Fakultas Teknologi Informasi',
                'position'      => 'Staff Al-Fatih Media Center (AMC)',
                'type'          => 'part-time',
                'start_date'    => '2023-04-01',
                'end_date'      => '2024-04-30',
                'location'      => 'Padang, Sumatera Barat, Indonesia · On-site',
                'description'   => [
                    'Served as Staff of Al-Fatih Media Center (AMC) within Al-Fatih FTI Unand, an Islamic study forum dedicated to fostering religious knowledge and community engagement among students of the Faculty of Information Technology at Universitas Andalas.',
                    'Responsible for managing and developing the organization\'s social media presence, including creating content for Islamic event announcements, religious commemorations, and organizational achievements. Contributed to the planning and execution of various Islamic events and study sessions, supporting the forum\'s mission to nurture a spiritually grounded and academically excellent campus community.',
                ],
                'skills'        => ['Graphic Design', 'Content Management', 'Design Thinking', 'Time Management', 'Creativity'],
                'logo_url'      => 'https://lh3.googleusercontent.com/proxy/PhFhXLGVukObz4vxSOb7uK-mkgdbA1MGB4Yvt6YXlRS64XoEZ-p9_dPB4wf6OL98zValT2vUMItDb4gCz8rKeFw',
                'media_urls'    => ['/img/Al -Fatih FTI Unand 2023.png'],
                'order'         => 7,
            ],

            // 8. HIMATEKOM
            [
                'company'       => 'HIMATEKOM',
                'position'      => 'Internal Division Staff',
                'type'          => 'contract',
                'start_date'    => '2023-05-01',
                'end_date'      => '2023-11-30',
                'location'      => 'Padang, Sumatera Barat, Indonesia · On-site',
                'description'   => [
                    'Served as Internal Division Staff at HIMATEKOM (Himpunan Mahasiswa Teknik Komputer), the official student association of the Computer Engineering department at Universitas Andalas. Contributed to the smooth internal operations of the organization throughout the active period.',
                    'Responsible for managing organizational correspondence and official documentation, ensuring all administrative processes were handled accurately and in a timely manner. Collaborated with the team to coordinate event timelines and scheduling, including the planning and management of duty rosters.',
                    'Additionally contributed to the association\'s entrepreneurial initiatives, supporting business activities organized by the student association as part of HIMATEKOM\'s broader mission to develop well-rounded, professionally competent members.',
                ],
                'skills'        => ['Time Management', 'Administrative Management', 'Documentation & Record Keeping', 'Correspondence Management', 'Team Coordination', 'Entrepreneurship'],
                'logo_url'      => 'https://www.himatekom.com/img/logo.png',
                'media_urls'    => ['/img/Himatekom Certificate.png', '/img/Pengurus Himatekom 2023.png', '/img/Rapat Pengurus Himatekom 2023.png'],
                'order'         => 8,
            ],
        ];

        foreach ($entries as $entry) {
            CareerEntry::create($entry);
        }
    }
}
