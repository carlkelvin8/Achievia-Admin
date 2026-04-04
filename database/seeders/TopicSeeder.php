<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            ['title' => 'Heart Anatomy', 'subject_id' => 1, 'content' => 'The heart is a muscular organ that pumps blood throughout the body.', 'video_link' => null],
            ['title' => 'Blood Circulation', 'subject_id' => 1, 'content' => 'Blood circulates through arteries, capillaries, and veins.', 'video_link' => null],
            ['title' => 'Insulin Production', 'subject_id' => 2, 'content' => 'The pancreas produces insulin to regulate blood glucose.', 'video_link' => null],
            ['title' => 'Thyroid Hormones', 'subject_id' => 2, 'content' => 'The thyroid gland produces hormones that regulate metabolism.', 'video_link' => null],
            ['title' => 'Gas Exchange', 'subject_id' => 3, 'content' => 'Oxygen and carbon dioxide are exchanged in the lungs.', 'video_link' => null],
            ['title' => 'Breathing Mechanics', 'subject_id' => 3, 'content' => 'The diaphragm and intercostal muscles control breathing.', 'video_link' => null],
            ['title' => 'Patient Hygiene', 'subject_id' => 4, 'content' => 'Maintaining patient hygiene is essential for comfort and health.', 'video_link' => null],
            ['title' => 'Infection Prevention', 'subject_id' => 5, 'content' => 'Proper hand hygiene is the most effective infection prevention measure.', 'video_link' => null],
            ['title' => 'Blood Pressure Measurement', 'subject_id' => 6, 'content' => 'Blood pressure is measured in millimeters of mercury (mmHg).', 'video_link' => null],
            ['title' => 'Pulse Assessment', 'subject_id' => 6, 'content' => 'Normal resting pulse is 60-100 beats per minute.', 'video_link' => null],
        ];

        foreach ($topics as $topic) {
            Topic::create($topic);
        }
    }
}
