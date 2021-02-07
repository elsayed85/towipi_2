<?php

use App\Models\General\Country;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            0 =>
            array(
                0 => '1',
                1 => 'القاهرة',
                2 => 'Cairo',
            ),
            1 =>
            array(
                0 => '2',
                1 => 'الجيزة',
                2 => 'Giza',
            ),
            2 =>
            array(
                0 => '3',
                1 => 'الأسكندرية',
                2 => 'Alexandria',
            ),
            3 =>
            array(
                0 => '4',
                1 => 'الدقهلية',
                2 => 'Dakahlia',
            ),
            4 =>
            array(
                0 => '5',
                1 => 'البحر الأحمر',
                2 => 'Red Sea',
            ),
            5 =>
            array(
                0 => '6',
                1 => 'البحيرة',
                2 => 'Beheira',
            ),
            6 =>
            array(
                0 => '7',
                1 => 'الفيوم',
                2 => 'Fayoum',
            ),
            7 =>
            array(
                0 => '8',
                1 => 'الغربية',
                2 => 'Gharbiya',
            ),
            8 =>
            array(
                0 => '9',
                1 => 'الإسماعلية',
                2 => 'Ismailia',
            ),
            9 =>
            array(
                0 => '10',
                1 => 'المنوفية',
                2 => 'Monofia',
            ),
            10 =>
            array(
                0 => '11',
                1 => 'المنيا',
                2 => 'Minya',
            ),
            11 =>
            array(
                0 => '12',
                1 => 'القليوبية',
                2 => 'Qaliubiya',
            ),
            12 =>
            array(
                0 => '13',
                1 => 'الوادي الجديد',
                2 => 'New Valley',
            ),
            13 =>
            array(
                0 => '14',
                1 => 'السويس',
                2 => 'Suez',
            ),
            14 =>
            array(
                0 => '15',
                1 => 'اسوان',
                2 => 'Aswan',
            ),
            15 =>
            array(
                0 => '16',
                1 => 'اسيوط',
                2 => 'Assiut',
            ),
            16 =>
            array(
                0 => '17',
                1 => 'بني سويف',
                2 => 'Beni Suef',
            ),
            17 =>
            array(
                0 => '18',
                1 => 'بورسعيد',
                2 => 'Port Said',
            ),
            18 =>
            array(
                0 => '19',
                1 => 'دمياط',
                2 => 'Damietta',
            ),
            19 =>
            array(
                0 => '20',
                1 => 'الشرقية',
                2 => 'Sharkia',
            ),
            20 =>
            array(
                0 => '21',
                1 => 'جنوب سيناء',
                2 => 'South Sinai',
            ),
            21 =>
            array(
                0 => '22',
                1 => 'كفر الشيخ',
                2 => 'Kafr Al sheikh',
            ),
            22 =>
            array(
                0 => '23',
                1 => 'مطروح',
                2 => 'Matrouh',
            ),
            23 =>
            array(
                0 => '24',
                1 => 'الأقصر',
                2 => 'Luxor',
            ),
            24 =>
            array(
                0 => '25',
                1 => 'قنا',
                2 => 'Qena',
            ),
            25 =>
            array(
                0 => '26',
                1 => 'شمال سيناء',
                2 => 'North Sinai',
            ),
            26 =>
            array(
                0 => '27',
                1 => 'سوهاج',
                2 => 'Sohag',
            ),
        );

        $egypt = Country::whereiso("EG")->first();

        foreach($data as $gov){
            $egypt->governorates()->create(['name_en' => $gov[2] , 'shipping_price' => rand(1,50)]);
        }
    }
}
