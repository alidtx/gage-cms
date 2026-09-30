<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->entities() as $data) {
            Entity::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }

    protected function entities(): array
    {
        return [
            [
                'name' => 'GAGE Security',
                'slug' => 'gage-security',
                'category' => 'security',
                'is_featured' => true,
                'sort_order' => 1,
                'meta' => [
                    'tagline' => 'Integrated Security Solutions',
                    'badge_text' => 'Flagship',
                    'badge_icon' => 'fa-star',
                    'short_description' => 'Comprehensive security systems for resorts, businesses, and government institutions.',
                    'icon' => '🔒',
                    'icon_type' => 'emoji',
                    'primary_color' => '#d4a847',
                    'secondary_color' => '#0a0a0a',
                    'meta_title' => 'GAGE Security – Experts in Safety & Security',
                    'meta_description' => 'Delivering comprehensive security solutions across the Maldives.',
                    'meta_keywords' => 'security maldives, cctv, access control',
                ],
                'content' => [
                    'hero' => [
                        'badge' => ['text' => '🔒 GAGE SECURITY', 'icon' => 'fa-lock'],
                        'title_line_1' => 'Experts in Safety',
                        'title_highlight' => '& Security.',
                        'subtitle' => 'Delivering comprehensive security solutions with vigilance, professionalism, and technology across the Maldives.',
                        'cta_primary' => ['text' => 'Explore Our Services', 'url' => '#services', 'icon' => 'fa-shield-alt'],
                        'cta_secondary' => ['text' => 'Contact Us', 'url' => '#contact', 'icon' => 'fa-envelope'],
                        'trust_badges' => ['24/7 Operations', 'Island-wide Coverage', 'Ex-Police Leadership'],
                    ],
                    'sections' => [
                        [
                            'key' => 'services',
                            'title' => 'Specialized Security Services',
                            'subtitle' => 'Our Expertise',
                            'type' => 'cards',
                            'items' => [
                                ['title' => 'Event Security', 'icon' => 'fa-calendar-alt', 'short_description' => 'Expert protection for events of all sizes.'],
                                ['title' => 'VIP Security', 'icon' => 'fa-crown', 'short_description' => 'Discreet, disciplined, proactive VIP protection.'],
                                ['title' => 'Cash in Transit', 'icon' => 'fa-truck', 'short_description' => 'Safe transportation of money and valuables.'],
                                ['title' => 'Intruder Alarm Service', 'icon' => 'fa-bell', 'short_description' => '24/7 monitoring for unauthorized access.'],
                                ['title' => 'Patrol Service', 'icon' => 'fa-car', 'short_description' => 'Mobile patrol units with GPS tracking.'],
                                ['title' => 'Marine Security', 'icon' => 'fa-ship', 'short_description' => 'Safeguarding ports, vessels, and maritime infra.'],
                            ],
                        ],
                        [
                            'key' => 'systems',
                            'title' => 'Security System',
                            'subtitle' => 'Technology',
                            'type' => 'feature-list',
                            'items' => [
                                ['title' => 'Access Control System', 'icon' => 'fa-door-open'],
                                ['title' => 'CCTV & Video Surveillance', 'icon' => 'fa-video'],
                                ['title' => 'Alarm Systems', 'icon' => 'fa-bell'],
                                ['title' => 'Intercom & Door Phone', 'icon' => 'fa-microchip'],
                                ['title' => 'Time & Attendance', 'icon' => 'fa-clock'],
                            ],
                        ],
                    ],
                    'contact' => [
                        'phone' => '+960 330 4055',
                        'email' => 'security@gage.com.mv',
                        'address' => 'H. Noomuraka, 1st Floor, Hadheebee Magu, Malé, Maldives',
                        'social' => ['facebook' => '', 'linkedin' => '', 'instagram' => ''],
                    ],
                ],
            ],

            [
                'name' => 'GAGE Safety',
                'slug' => 'gage-safety',
                'category' => 'safety',
                'sort_order' => 2,
                'meta' => [
                    'tagline' => 'Fire & Life Safety Solutions',
                    'badge_text' => 'Fire Protection',
                    'badge_icon' => 'fa-fire-extinguisher',
                    'short_description' => 'End-to-end fire protection and life safety solutions.',
                    'icon' => '🛡️',
                    'primary_color' => '#bb292a',
                    'secondary_color' => '#0a1a2f',
                ],
                'content' => [
                    'hero' => [
                        'badge' => ['text' => '🛡️ GAGE SAFETY'],
                        'title_line_1' => 'Protecting Lives',
                        'title_highlight' => 'Every Day.',
                        'subtitle' => 'End-to-end fire protection and life safety solutions for resorts, businesses, and institutions.',
                        'trust_badges' => ['Fire Safety Audits', 'Compliance Certified'],
                    ],
                    'sections' => [
                        [
                            'key' => 'services',
                            'title' => 'Fire Protection Services',
                            'type' => 'cards',
                            'items' => [
                                ['title' => 'Fire Detection', 'icon' => 'fa-fire', 'short_description' => 'Intelligent early warning detection systems.'],
                                ['title' => 'Suppression Systems', 'icon' => 'fa-shower', 'short_description' => 'Sprinkler & gas suppression systems.'],
                                ['title' => 'Evacuation', 'icon' => 'fa-running', 'short_description' => 'Emergency lighting and evacuation plans.'],
                            ],
                        ],
                    ],
                    'contact' => [
                        'phone' => '+960 330 4055',
                        'email' => 'safety@gage.com.mv',
                        'address' => 'H. Noomuraka, 1st Floor, Hadheebee Magu, Malé, Maldives',
                    ],
                ],
            ],

            [
                'name' => 'GAGE Institute',
                'slug' => 'gage-institute',
                'category' => 'training',
                'sort_order' => 3,
                'meta' => [
                    'tagline' => 'Training & Certification Center',
                    'badge_text' => 'Accredited',
                    'badge_icon' => 'fa-certificate',
                    'short_description' => 'Internationally recognized training programs for lifeguards, first responders, and security professionals.',
                    'icon' => '🎓',
                    'primary_color' => '#1e3a8a',
                    'secondary_color' => '#0a1a2f',
                ],
                'content' => [
                    'hero' => [
                        'badge' => ['text' => '🎓 GAGE TRAINING INSTITUTE'],
                        'title_line_1' => 'Building Capable Professionals,',
                        'title_highlight' => 'Since Day One.',
                        'subtitle' => 'Accredited, hands-on programmes in security, safety, and emergency response.',
                        'trust_badges' => ['MQA Approved', '50+ Programmes', 'Guaranteed Job Links'],
                    ],
                    'about' => [
                        'title' => 'Developing Capable Professionals',
                        'subtitle' => 'About GTI',
                        'description' => 'GAGE Training Institute develops capable professionals in security, safety, and emergency response through accredited, hands-on programmes.',
                        'vision' => 'To build a legacy in providing the best client and candidate services.',
                        'mission' => 'Incessantly working towards being the premier resource for meeting the needs of the hospitality industry.',
                    ],
                    'sections' => [
                        [
                            'key' => 'approach',
                            'title' => 'Practical, Job-Based Training',
                            'subtitle' => 'Our Approach',
                            'type' => 'cards',
                            'items' => [
                                ['title' => 'Mobile Classes', 'icon' => 'fa-map-marker-alt', 'short_description' => 'Conducted on-site in resorts.'],
                                ['title' => 'Weekend & Evening', 'icon' => 'fa-clock', 'short_description' => 'For working students in Malé.'],
                                ['title' => 'Virtual Classrooms', 'icon' => 'fa-laptop', 'short_description' => 'For all those out of reach.'],
                            ],
                        ],
                    ],
                    'programmes' => [
                        'title' => 'Our Programmes',
                        'subtitle' => 'What We Offer',
                        'items' => [
                            ['title' => 'Safety & Emergency Response', 'icon' => 'fa-shield-alt', 'count' => 10, 'description' => 'Life-saving response, fire safety and occupational health.'],
                            ['title' => 'Security & Protective Services', 'icon' => 'fa-user-shield', 'count' => 7, 'description' => 'MQA-approved Security Officer certificate.'],
                            ['title' => 'Investigations & Financial Crime', 'icon' => 'fa-search-dollar', 'count' => 6, 'description' => 'For criminal and financial investigators.'],
                            ['title' => 'Cybersecurity', 'icon' => 'fa-lock', 'count' => 5, 'description' => 'From cyber awareness to specialist techniques.'],
                            ['title' => 'Command & Leadership', 'icon' => 'fa-chess-king', 'count' => 6, 'description' => 'For executive management and commanders.'],
                        ],
                    ],
                    'team' => [
                        'title' => 'Learn from Industry Leaders',
                        'subtitle' => 'Trainer Highlights',
                        'members' => [
                            [
                                'name' => 'Dr. Aishath Shina',
                                'position' => 'Assistant Professor; Dean, Kulliyah of Education',
                                'bio' => 'With over 20 years of experience in the education sector...',
                                'qualifications' => ['PhD in Education', '20+ Years Experience', 'National Award 2024'],
                            ],
                        ],
                    ],
                    'contact' => [
                        'phone' => '+960 330 4055',
                        'email' => 'training@gage.com.mv',
                        'address' => 'H. Noomuraka, 1st Floor, Hadheebee Magu, Malé, Maldives',
                    ],
                ],
            ],

            [
                'name' => 'GAGE Store',
                'slug' => 'gage-store',
                'category' => 'retail',
                'sort_order' => 4,
                'meta' => [
                    'tagline' => 'Safety Equipment & Supplies',
                    'badge_text' => 'Retail',
                    'badge_icon' => 'fa-shopping-bag',
                    'short_description' => 'One-stop shop for all your safety and security equipment needs.',
                    'icon' => '🛒',
                    'primary_color' => '#5c1a1b',
                    'secondary_color' => '#3d1011',
                ],
                'content' => [
                    'hero' => [
                        'badge' => ['text' => '🛒 GAGE STORE'],
                        'title_line_1' => 'Your One-Stop Shop for',
                        'title_highlight' => 'Safety & Security.',
                        'subtitle' => 'Comprehensive range of fire safety and security equipment from globally recognized brands.',
                        'trust_badges' => ['Certified Products', 'Island-wide Delivery'],
                    ],
                    'sections' => [
                        [
                            'key' => 'categories',
                            'title' => 'Product Categories',
                            'subtitle' => 'Our Range',
                            'type' => 'icon-grid',
                            'items' => [
                                ['title' => 'Fire Extinguishers', 'icon' => 'fa-fire-extinguisher', 'short_description' => 'All types: Powder, Foam, CO2'],
                                ['title' => 'Fire Alarm Systems', 'icon' => 'fa-bell', 'short_description' => 'Panels, detectors, sounders'],
                                ['title' => 'CCTV & Surveillance', 'icon' => 'fa-video', 'short_description' => 'Cameras, DVRs, NVRs, monitors'],
                                ['title' => 'Access Control', 'icon' => 'fa-lock', 'short_description' => 'Card readers, biometrics, intercoms'],
                                ['title' => 'Fire Hydrants & Hose', 'icon' => 'fa-faucet', 'short_description' => 'Hydrants, hose reels, nozzles'],
                                ['title' => 'PPE & Safety Gear', 'icon' => 'fa-hard-hat', 'short_description' => 'Helmets, suits, gloves, boots'],
                                ['title' => 'First Aid & Medical', 'icon' => 'fa-first-aid', 'short_description' => 'Kits, supplies, AEDs'],
                                ['title' => 'Signage & Lighting', 'icon' => 'fa-sign', 'short_description' => 'Emergency signs, exit lights'],
                            ],
                        ],
                        [
                            'key' => 'partners',
                            'title' => 'Trusted Global Brands',
                            'subtitle' => 'Our Partners',
                            'type' => 'logo-grid',
                            'items' => [
                                ['name' => 'AJAX'],
                                ['name' => 'HIKVISION'],
                                ['name' => 'BOSCH'],
                                ['name' => 'SIEMENS'],
                                ['name' => 'NAFFCO'],
                                ['name' => 'BRISTOL'],
                                ['name' => 'FIREX'],
                                ['name' => 'COOPER'],
                                ['name' => 'FirePro'],
                                ['name' => 'COFEM'],
                            ],
                        ],
                    ],
                    'contact' => [
                        'phone' => '+960 330 4055',
                        'email' => 'sales@gage.com.mv',
                        'address' => 'H. Noomuraka, 1st Floor, Hadheebee Magu, Malé, Maldives',
                    ],
                ],
            ],

            [
                'name' => 'GAGE Consulting',
                'slug' => 'gage-consulting',
                'category' => 'consulting',
                'sort_order' => 5,
                'meta' => [
                    'tagline' => 'Security & Risk Advisory',
                    'badge_text' => 'Advisory',
                    'badge_icon' => 'fa-brain',
                    'short_description' => 'Strategic security consulting and risk assessment services.',
                    'icon' => '📋',
                    'primary_color' => '#bb292a',
                    'secondary_color' => '#0a1a2f',
                ],
                'content' => [
                    'hero' => [
                        'badge' => ['text' => '📋 GAGE CONSULTING'],
                        'title_line_1' => 'Strategic Security,',
                        'title_highlight' => 'Decisive Action.',
                        'subtitle' => 'Leverage decades of law enforcement and security expertise to protect your organization.',
                        'trust_badges' => ['Ex-Police Leadership', 'Decades of Experience'],
                    ],
                    'sections' => [
                        [
                            'key' => 'services',
                            'title' => 'Advisory Services',
                            'type' => 'cards',
                            'items' => [
                                ['title' => 'Risk Assessments', 'icon' => 'fa-clipboard-check', 'short_description' => 'Comprehensive security risk assessments.'],
                                ['title' => 'Security Audits', 'icon' => 'fa-search', 'short_description' => 'Audits & gap analysis.'],
                                ['title' => 'Crisis Management', 'icon' => 'fa-exclamation-triangle', 'short_description' => 'Business continuity planning.'],
                                ['title' => 'Policy Development', 'icon' => 'fa-file-contract', 'short_description' => 'Security policy & procedure development.'],
                            ],
                        ],
                    ],
                    'contact' => [
                        'phone' => '+960 330 4055',
                        'email' => 'consulting@gage.com.mv',
                        'address' => 'H. Noomuraka, 1st Floor, Hadheebee Magu, Malé, Maldives',
                    ],
                ],
            ],

            [
                'name' => 'GAGE Marine',
                'slug' => 'gage-marine',
                'category' => 'marine',
                'sort_order' => 6,
                'meta' => [
                    'tagline' => 'Maritime Safety Solutions',
                    'badge_text' => 'Maritime',
                    'badge_icon' => 'fa-ship',
                    'short_description' => 'Specialized safety solutions for the marine environment.',
                    'icon' => '⛵',
                    'primary_color' => '#bb292a',
                    'secondary_color' => '#0a1a2f',
                ],
                'content' => [
                    'hero' => [
                        'badge' => ['text' => '⛵ GAGE MARINE'],
                        'title_line_1' => 'Safety On and',
                        'title_highlight' => 'Around the Water.',
                        'subtitle' => 'From resort water sports to vessel operations — ensuring safety on and around the water.',
                        'trust_badges' => ['Certified Inspections', 'Resort Specialists'],
                    ],
                    'sections' => [
                        [
                            'key' => 'services',
                            'title' => 'Marine Safety Services',
                            'type' => 'cards',
                            'items' => [
                                ['title' => 'Marine Safety Equipment', 'icon' => 'fa-life-ring', 'short_description' => 'Supply of safety equipment.'],
                                ['title' => 'Water Sports Safety', 'icon' => 'fa-swimmer', 'short_description' => 'Water sports safety management.'],
                                ['title' => 'Vessel Inspections', 'icon' => 'fa-clipboard-list', 'short_description' => 'Vessel safety inspections.'],
                                ['title' => 'Emergency Planning', 'icon' => 'fa-first-aid', 'short_description' => 'Marine emergency response planning.'],
                            ],
                        ],
                    ],
                    'contact' => [
                        'phone' => '+960 330 4055',
                        'email' => 'marine@gage.com.mv',
                        'address' => 'H. Noomuraka, 1st Floor, Hadheebee Magu, Malé, Maldives',
                    ],
                ],
            ],
        ];
    }
}