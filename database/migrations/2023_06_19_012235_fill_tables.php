<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Bouquet;
use App\Models\Type;
use App\Models\Color;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Bouquet::create(['name' => "Срібло", 'category' => "Мікс букети", 'price' => 1000, 'material' => 'Папір', 'size' => "Середній", 'description' => "Весняний букет для найніжнішої та найчуттєвішої", 'composition' => "35 білих тюльпанів, 16 ірисів, берграс, оформлення.", 'img_name' => "catalog_item3.png", 'best_offer' => false]);
        Bouquet::create(['name' => "Прихильність фортуни", 'category' => "Моно букети", 'price' => 900, 'material' => 'Плівка', 'size' => "Середній", 'description' => "Елегантний букет, який втілює в собі витонченість і чарівність, створений, щоб порадувати найвишуканіший смак.", 'composition' => "50 ірисів", 'img_name' => "catalog_item1.png", 'best_offer' => false]);
        Bouquet::create(['name' => "Цитрусові сутінки", 'category' => "Весільні букети", 'price' => 1100, 'material' => 'Плівка', 'size' => "Великий", 'description' => "Магічний букет, наповнений ароматами квітів та кольоровою експлозією, призначений для осяяння життя найвиразнішої та найрізноманітнішої особи.", 'composition' => "16 ірисів, 16 білих троянд, 16 рожевих троянд, берграс", 'img_name' => "catalog_item2.png", 'best_offer' => false]);
        Bouquet::create(['name' => "Зачароване цвітіння", 'category' => "Мікс букети", 'price' => 850, 'material' => 'Папір', 'size' => "Малий", 'description' => "Квітковий витвір у відтінках рожевого та білого створений, щоб подарувати незабутні миті радості та ніжності.", 'composition' => "10 ірисів, 10 жовтих тюльпанів, 10 рожевих тюльпанів", 'img_name' => "catalog_item4.png", 'best_offer' => false]);
        Bouquet::create(['name' => "Солодкі аромати весни", 'category' => "Мікс букети", 'price' => 850, 'material' => 'Папір', 'size' => "Малий", 'description' => "Чарівний букет, наповнений ароматом квітів і кольорами радості, створений спеціально для того, щоб подарувати найщиріші почуття та незабутні миті радості.", 'composition' => "10 ірисів, 10 жовтих тюльпанів, 10 білих тюльпанів", 'img_name' => "catalog_item5.png", 'best_offer' => false]);
        Bouquet::create(['name' => "Солодкі аромати весни", 'category' => "Мікс букети", 'price' => 850, 'material' => 'Плівка', 'size' => "Малий", 'description' => "Ароматний букет з яскравими квітами, створений для найвишуканіших смаків та витончених осіб.", 'composition' => "16 ірисів, 16 ромашок", 'img_name' => "catalog_item6.png", 'best_offer' => false]);
        Bouquet::create(['name' => "Втончений мікс", 'category' => "Мікс букети", 'price' => 1800, 'material' => 'Плівка', 'size' => "Великий", 'description' => "Соковитий букет, наповнений свіжістю та красою, як створений для особи, що втілює в собі ніжність та чутливість.", 'composition' => "16 рожевих троянд, 16 білих троянд, 8 білих лілій, 8 білих орхідей", 'img_name' => "flowers1.png", 'best_offer' => true]);
        Bouquet::create(['name' => "Ніжний моно", 'category' => "Моно букети", 'price' => 1300, 'material' => 'Плівка', 'size' => "Середній", 'description' => "Казковий букет з неповторних квітів, що випромінюють кольорову радість і надають особливий шарм, створений для дотепної та неперевершеної особи.", 'composition' => "32 рожевих тюльпанів, евкаліпт", 'img_name' => "flowers2.png", 'best_offer' => true]);
        Bouquet::create(['name' => "Чарівний мікс", 'category' => "Мікс букети", 'price' => 1500, 'material' => 'Плівка', 'size' => "Середній", 'description' => "Ніжність та чарівність літнього букету, який втілює в собі багатство кольорів та ароматів природи.", 'composition' => "3 рожеві гортензії, 10 жовтих троянд, 8 білих троянд, евкаліпт", 'img_name' => "flowers3.png", 'best_offer' => true]);
        Bouquet::create(['name' => "Весняний моно", 'category' => "Моно букети", 'price' => 1800, 'material' => 'Плівка', 'size' => "Великий", 'description' => "Казковий букет, сповнений ніжності та краси, який розквітає в усій своїй величі, дарує відчуття магії та незабутніх емоцій.", 'composition' => "50 жовтих троянд", 'img_name' => "flowers4.png", 'best_offer' => true]);

        Type::create(['type' => "Іриси"]);
        Type::create(['type' => "Тюльпани"]);
        Type::create(['type' => "Троянди"]);
        Type::create(['type' => "Ромашки"]);
        Type::create(['type' => "Лілії"]);
        Type::create(['type' => "Орхідеї"]);
        Type::create(['type' => "Гортензії"]);

        Color::create(['color' => "Білий"]);
        Color::create(['color' => "Жовтий"]);
        Color::create(['color' => "Рожевий"]);
        Color::create(['color' => "Фіолетовий"]);

        DB::table('bouquets_types')->insert(
            array(
                ['bouquet_id' => 1, 'type_id' => 1],
                ['bouquet_id' => 1, 'type_id' => 2],
                ['bouquet_id' => 2, 'type_id' => 1],
                ['bouquet_id' => 3, 'type_id' => 1],
                ['bouquet_id' => 3, 'type_id' => 3],
                ['bouquet_id' => 4, 'type_id' => 1],
                ['bouquet_id' => 4, 'type_id' => 2],
                ['bouquet_id' => 5, 'type_id' => 1],
                ['bouquet_id' => 5, 'type_id' => 2],
                ['bouquet_id' => 6, 'type_id' => 1],
                ['bouquet_id' => 6, 'type_id' => 4],
                ['bouquet_id' => 7, 'type_id' => 3],
                ['bouquet_id' => 7, 'type_id' => 5],
                ['bouquet_id' => 7, 'type_id' => 6],
                ['bouquet_id' => 8, 'type_id' => 2],
                ['bouquet_id' => 9, 'type_id' => 3],
                ['bouquet_id' => 9, 'type_id' => 7],
                ['bouquet_id' => 10, 'type_id' => 3],
            )
        );

        DB::table('bouquets_colors')->insert(
            array(
                ['bouquet_id' => 1, 'color_id' => 1],
                ['bouquet_id' => 1, 'color_id' => 4],
                ['bouquet_id' => 2, 'color_id' => 4],
                ['bouquet_id' => 3, 'color_id' => 4],
                ['bouquet_id' => 3, 'color_id' => 1],
                ['bouquet_id' => 3, 'color_id' => 3],
                ['bouquet_id' => 4, 'color_id' => 4],
                ['bouquet_id' => 4, 'color_id' => 2],
                ['bouquet_id' => 4, 'color_id' => 3],
                ['bouquet_id' => 5, 'color_id' => 4],
                ['bouquet_id' => 5, 'color_id' => 2],
                ['bouquet_id' => 5, 'color_id' => 1],
                ['bouquet_id' => 6, 'color_id' => 1],
                ['bouquet_id' => 6, 'color_id' => 4],
                ['bouquet_id' => 7, 'color_id' => 3],
                ['bouquet_id' => 7, 'color_id' => 1],
                ['bouquet_id' => 8, 'color_id' => 3],
                ['bouquet_id' => 9, 'color_id' => 1],
                ['bouquet_id' => 9, 'color_id' => 2],
                ['bouquet_id' => 9, 'color_id' => 3],
                ['bouquet_id' => 10, 'color_id' => 2],
            ));
    }

};
