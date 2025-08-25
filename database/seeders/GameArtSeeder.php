<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GameArtSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $records = [
        [
            'id' => 1,
            'gameName' => 'Dragon King',
            'gameId' => 8,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/8_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 2,
            'gameName' => 'Wild Dolphin',
            'gameId' => 9,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/9_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 3,
            'gameName' => 'Venetia',
            'gameId' => 12,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/12_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 4,
            'gameName' => 'Lady Luck',
            'gameId' => 13,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/13_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 5,
            'gameName' => 'Wolf Quest',
            'gameId' => 14,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/14_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 6,
            'gameName' => 'Explosive Reels',
            'gameId' => 18,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/18_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 7,
            'gameName' => 'Gold Of Ra',
            'gameId' => 19,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/19_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 8,
            'gameName' => 'Dancing Lions',
            'gameId' => 20,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/20_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 9,
            'gameName' => 'Phoenix Princess',
            'gameId' => 21,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/21_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 10,
            'gameName' => 'Fortune Panda',
            'gameId' => 22,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/22_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 11,
            'gameName' => 'Magic Unicorn',
            'gameId' => 25,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/25_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 12,
            'gameName' => 'Ancient Gong',
            'gameId' => 26,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/26_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 13,
            'gameName' => 'Power Dragon',
            'gameId' => 27,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/27_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 14,
            'gameName' => 'Jumpin Pot',
            'gameId' => 71,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/71_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 15,
            'gameName' => 'African Sunset',
            'gameId' => 73,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/73_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 16,
            'gameName' => 'Kitty Twins',
            'gameId' => 77,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/77_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 17,
            'gameName' => 'Tesla',
            'gameId' => 81,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/81_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 18,
            'gameName' => 'DaVinci Codex',
            'gameId' => 82,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/82_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 19,
            'gameName' => 'Cleopatra Jewels',
            'gameId' => 99,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/99_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 20,
            'gameName' => 'Atlantis World',
            'gameId' => 100,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/100_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 21,
            'gameName' => 'Crystal Mystery',
            'gameId' => 102,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/102_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 22,
            'gameName' => '5 Star Luxury',
            'gameId' => 103,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/103_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 23,
            'gameName' => 'More Cash',
            'gameId' => 104,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/104_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 24,
            'gameName' => 'Money Farm',
            'gameId' => 105,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/105_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 25,
            'gameName' => 'Dragon Lady',
            'gameId' => 113,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/113_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 26,
            'gameName' => 'Burning Flame',
            'gameId' => 114,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/114_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 27,
            'gameName' => 'Royal Gems',
            'gameId' => 115,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/115_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 28,
            'gameName' => 'Storming Flame',
            'gameId' => 116,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/116_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 29,
            'gameName' => 'Star Cash',
            'gameId' => 119,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/119_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 30,
            'gameName' => 'Jade Treasure',
            'gameId' => 132,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/132_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 31,
            'gameName' => '88 Riches',
            'gameId' => 133,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/133_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 32,
            'gameName' => 'King Of Wealth',
            'gameId' => 134,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/134_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 33,
            'gameName' => 'Fortune Lions',
            'gameId' => 135,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/135_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 34,
            'gameName' => 'Ramses Treasure',
            'gameId' => 137,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/137_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 35,
            'gameName' => 'Caligula',
            'gameId' => 138,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/138_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 36,
            'gameName' => 'Golden Dragon',
            'gameId' => 139,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/139_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 37,
            'gameName' => 'Lucky Babies',
            'gameId' => 140,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/140_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 38,
            'gameName' => '3 Kings',
            'gameId' => 141,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/141_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 39,
            'gameName' => 'Thunder Bird',
            'gameId' => 142,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/142_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 40,
            'gameName' => 'Magic Dragon',
            'gameId' => 143,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/143_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 41,
            'gameName' => 'Texas Rangers Reward',
            'gameId' => 144,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/144_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 42,
            'gameName' => 'Money Farm 2',
            'gameId' => 145,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/145_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 43,
            'gameName' => 'Tiger Heart',
            'gameId' => 146,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/146_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 44,
            'gameName' => 'Castle Blood',
            'gameId' => 165,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/165_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 45,
            'gameName' => 'Queen Of The Seas',
            'gameId' => 186,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/186_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 46,
            'gameName' => 'Emperors Wealth',
            'gameId' => 188,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/188_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 47,
            'gameName' => 'El Toreo',
            'gameId' => 189,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/189_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 48,
            'gameName' => 'Spartans Legacy',
            'gameId' => 190,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/190_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 49,
            'gameName' => 'King Of Monkeys',
            'gameId' => 191,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/191_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 50,
            'gameName' => 'Slot Of Money',
            'gameId' => 192,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/192_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 51,
            'gameName' => 'Flaming Reels',
            'gameId' => 193,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/193_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 52,
            'gameName' => 'Four Symbols',
            'gameId' => 194,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/194_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 53,
            'gameName' => 'Chinese Zodiac',
            'gameId' => 195,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/195_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 54,
            'gameName' => 'King Of Monkeys 2',
            'gameId' => 196,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/196_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 55,
            'gameName' => 'Night At KTV',
            'gameId' => 197,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/197_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 56,
            'gameName' => 'Joan Of Arc',
            'gameId' => 199,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/199_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 57,
            'gameName' => 'Santa\'s Farm',
            'gameId' => 200,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/200_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 58,
            'gameName' => 'Circus of Horror',
            'gameId' => 201,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/201_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 59,
            'gameName' => 'Peter\'s Universe',
            'gameId' => 202,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/202_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 60,
            'gameName' => 'Azrabah Wishes',
            'gameId' => 203,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/203_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 61,
            'gameName' => 'Captain Candy',
            'gameId' => 204,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/204_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 62,
            'gameName' => 'Battle for Atlantis',
            'gameId' => 205,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/205_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 63,
            'gameName' => 'Book Of Oziris',
            'gameId' => 206,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/206_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 64,
            'gameName' => 'Monkey Pirates',
            'gameId' => 207,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/207_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 65,
            'gameName' => 'Chili Quest',
            'gameId' => 208,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/208_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 66,
            'gameName' => 'Dragon Whisperer',
            'gameId' => 209,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/209_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 67,
            'gameName' => 'Lucky Coins',
            'gameId' => 224,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/224_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 68,
            'gameName' => 'Norns Fate',
            'gameId' => 225,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/225_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 69,
            'gameName' => 'Wolf Hunt',
            'gameId' => 226,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/226_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 70,
            'gameName' => 'Battle For Cosmos',
            'gameId' => 228,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/228_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 71,
            'gameName' => 'Bubble Fruits',
            'gameId' => 229,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/229_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 72,
            'gameName' => 'Book of Alchemy',
            'gameId' => 231,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/231_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 73,
            'gameName' => 'Wild Wild Quest',
            'gameId' => 232,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/232_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 74,
            'gameName' => 'Dawn Of Olympus',
            'gameId' => 233,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/233_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 75,
            'gameName' => 'Apocalypse Quest',
            'gameId' => 234,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/234_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 76,
            'gameName' => 'Hawaiian Fruits',
            'gameId' => 235,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/235_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 77,
            'gameName' => 'Piggy Holmes',
            'gameId' => 236,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/236_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 78,
            'gameName' => 'African Sunset 2',
            'gameId' => 238,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/238_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 79,
            'gameName' => 'Hawaiian Christmas',
            'gameId' => 239,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/239_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 80,
            'gameName' => 'Mariachi Fiesta',
            'gameId' => 240,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/240_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 81,
            'gameName' => 'Nefertiti\'s Nile',
            'gameId' => 289,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/289_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 82,
            'gameName' => 'Ali Baba\'s Riches',
            'gameId' => 290,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/290_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 83,
            'gameName' => 'Dolphin\'s Dream',
            'gameId' => 293,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/293_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 84,
            'gameName' => 'Sushi Yatta',
            'gameId' => 297,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/297_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 85,
            'gameName' => 'Piggy Bjorn - Muspelheim\'s Treasure',
            'gameId' => 303,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/303_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 86,
            'gameName' => 'Summer Jam',
            'gameId' => 306,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/306_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 87,
            'gameName' => 'EuropeanRoulette',
            'gameId' => 307,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart_tablegame/307_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 88,
            'gameName' => 'Dynamite Fruits',
            'gameId' => 309,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/309_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 89,
            'gameName' => 'BlackJack',
            'gameId' => 310,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart_tablegame/310_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 90,
            'gameName' => 'Hollywoof',
            'gameId' => 311,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/311_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 91,
            'gameName' => 'Super Heated 7s',
            'gameId' => 312,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/312_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 92,
            'gameName' => 'Spooky Graves',
            'gameId' => 313,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/313_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 93,
            'gameName' => 'Xtreme Hot',
            'gameId' => 314,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/314_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 94,
            'gameName' => 'Hot Fruit Delights',
            'gameId' => 315,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/315_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 95,
            'gameName' => 'Santa\'s Factory',
            'gameId' => 317,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/317_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 96,
            'gameName' => 'Caribbean Stud Poker',
            'gameId' => 318,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart_tablegame/318_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 97,
            'gameName' => 'Video Poker',
            'gameId' => 319,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart_tablegame/319_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 98,
            'gameName' => 'Baccarat',
            'gameId' => 321,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart_tablegame/321_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 99,
            'gameName' => 'Book of Cupigs',
            'gameId' => 323,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/323_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 100,
            'gameName' => 'Diamond Magic',
            'gameId' => 324,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/324_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 101,
            'gameName' => 'Flaming Fruits',
            'gameId' => 325,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/325_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 102,
            'gameName' => '20 Hot Fruit Delights',
            'gameId' => 326,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/326_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 103,
            'gameName' => '40 Super Heated Sevens',
            'gameId' => 327,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/327_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 104,
            'gameName' => 'Sevens and Diamonds',
            'gameId' => 337,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/337_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 105,
            'gameName' => 'Buffaloes Duel',
            'gameId' => 339,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/339_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 106,
            'gameName' => 'Dynamite Fruits Deluxe',
            'gameId' => 342,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/342_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 107,
            'gameName' => 'Angry Dogs',
            'gameId' => 344,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/344_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 108,
            'gameName' => 'Striking Joker',
            'gameId' => 345,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/345_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 109,
            'gameName' => 'Book Of Museum',
            'gameId' => 346,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/346_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 110,
            'gameName' => 'Aladdin\'s Quest',
            'gameId' => 347,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/347_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 111,
            'gameName' => 'Xtreme Summer Hot',
            'gameId' => 348,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/348_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 112,
            'gameName' => 'Wild Wild Fruit',
            'gameId' => 349,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/349_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 113,
            'gameName' => 'Surfin\' Joker',
            'gameId' => 350,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/350_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 114,
            'gameName' => 'Wild Marmalade',
            'gameId' => 351,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/351_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 115,
            'gameName' => 'Blackjack – Side Bets',
            'gameId' => 352,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart_tablegame/352_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 116,
            'gameName' => 'Diamond Magic Deluxe',
            'gameId' => 353,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/353_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 117,
            'gameName' => 'Awesome 7s',
            'gameId' => 354,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/354_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 118,
            'gameName' => 'Piggy Bjorn 2 - Winter is coming',
            'gameId' => 355,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/355_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 119,
            'gameName' => 'Jingle Jokers',
            'gameId' => 357,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/357_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 120,
            'gameName' => 'Safari Gems',
            'gameId' => 358,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/358_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 121,
            'gameName' => 'Lunar Rabbit',
            'gameId' => 360,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/360_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 122,
            'gameName' => 'Frozen Joker',
            'gameId' => 361,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/361_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 123,
            'gameName' => '100 Lucky Sevens',
            'gameId' => 371,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/371_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 124,
            'gameName' => 'Pirate’s Pearl Megaways™',
            'gameId' => 372,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/372_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 125,
            'gameName' => 'Money Farm Megaways™',
            'gameId' => 373,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/373_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 126,
            'gameName' => 'Angry Dragons',
            'gameId' => 374,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/374_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 127,
            'gameName' => 'Gems Elevator',
            'gameId' => 375,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/375_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 128,
            'gameName' => 'Pixel Invaders',
            'gameId' => 376,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/376_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 129,
            'gameName' => 'Kukulkan’s Queen',
            'gameId' => 377,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/377_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 130,
            'gameName' => 'Buffalo Sunset',
            'gameId' => 378,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/378_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 131,
            'gameName' => '40 Lucky Sevens',
            'gameId' => 379,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/379_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 132,
            'gameName' => 'Fate’s Fury',
            'gameId' => 380,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/380_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 133,
            'gameName' => '40 Super Blazing Sevens',
            'gameId' => 381,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/381_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 134,
            'gameName' => 'Lucky Reefs',
            'gameId' => 385,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/385_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 135,
            'gameName' => 'Raiders Of The Lost Book',
            'gameId' => 386,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/386_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 136,
            'gameName' => 'Lucky Fruits And Diamonds',
            'gameId' => 387,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/387_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 137,
            'gameName' => 'Greek Pantheon Megaways',
            'gameId' => 389,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/389_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 138,
            'gameName' => 'Great Buffalo Hold\'n Win',
            'gameId' => 390,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/390_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 139,
            'gameName' => '7s Fury 20',
            'gameId' => 391,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/391_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 140,
            'gameName' => 'Halloween Farm',
            'gameId' => 392,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/392_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 141,
            'gameName' => 'X-mas Express',
            'gameId' => 393,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/393_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 142,
            'gameName' => 'Yellow Diver',
            'gameId' => 394,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/394_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 143,
            'gameName' => 'Ragna’s Rock',
            'gameId' => 395,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/395_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 144,
            'gameName' => '10 Lucky Sevens',
            'gameId' => 396,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/396_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 145,
            'gameName' => '5 Lucky Sevens',
            'gameId' => 397,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/397_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 146,
            'gameName' => 'Candy Trouble',
            'gameId' => 403,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/403_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 147,
            'gameName' => 'Surfin\' Joker Dice',
            'gameId' => 406,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/406_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 148,
            'gameName' => 'Wolf Hunt Dice',
            'gameId' => 407,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/407_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 149,
            'gameName' => '20 Super Sevens',
            'gameId' => 410,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/410_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 150,
            'gameName' => 'Golden Furong',
            'gameId' => 412,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/412_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 151,
            'gameName' => 'Hot Glowing Fruits',
            'gameId' => 414,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/414_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 152,
            'gameName' => 'Shining Royal 100',
            'gameId' => 415,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/415_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 153,
            'gameName' => 'Clover Goes Wild',
            'gameId' => 416,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/416_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 154,
            'gameName' => 'Shining Royal 40',
            'gameId' => 417,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/417_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ],
        [
            'id' => 155,
            'gameName' => 'Big Fruit Show',
            'gameId' => 418,
            'thumbnail' => 'https://hg4dev.gahypergaming.com/thumbnails/gameart/418_370x280.jpg',
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null
        ]
    ];

        foreach (array_chunk($records, 500) as $chunk) {
            DB::table('tb_gameart_list')->insert($chunk);
        }
    }
}
