-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 17 2016 г., 18:53
-- Версия сервера: 5.7.9
-- Версия PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mega_research`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qId` int(10) UNSIGNED NOT NULL,
  `qNum` varchar(10) DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `step_id` (`qId`)
) ENGINE=MyISAM AUTO_INCREMENT=494 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `qId`, `qNum`, `answer`) VALUES
(1, 1, 'S1', 'Фамилия'),
(2, 1, 'S1', 'Имя'),
(3, 1, 'S1', 'Отчество'),
(4, 2, '', 'Мужской'),
(5, 2, '', 'Женский'),
(6, 3, '', 'Впишите число полных лет цифрами'),
(7, 4, '', 'Женат (Замужем)/ живет вместе'),
(8, 4, '', 'Холост (Не замужем)/ разведен (а)/ вдовец (вдова)'),
(9, 5, '', 'Да'),
(10, 5, '', 'Нет'),
(11, 6, '', '1 ребенок'),
(12, 6, '', '2 детей'),
(13, 6, '', '3 детей'),
(14, 6, '', '4 детей'),
(15, 6, '', '5 детей'),
(16, 6, '', 'Более'),
(17, 7, '', 'футбол'),
(18, 7, '', 'волейбол'),
(19, 7, '', 'баскетбол'),
(20, 7, '', 'хоккей'),
(21, 7, '', 'легкая атлетика'),
(22, 7, '', 'большой теннис'),
(23, 7, '', 'настольный теннис'),
(24, 7, '', 'борьба, восточные единоборства'),
(25, 7, '', 'бокс'),
(26, 7, '', 'фитнес, аэробика'),
(27, 7, '', 'бодибилдинг, тренажерный зал'),
(28, 7, '', 'катание на коньках'),
(29, 7, '', 'беговые лыжи'),
(30, 7, '', 'горные лыжи, сноуборд'),
(31, 7, '', 'катание на велосипеде'),
(32, 7, '', 'катание на роликах'),
(33, 7, '', 'скейтборд'),
(34, 7, '', 'туризм'),
(35, 7, '', 'другие виды спорта'),
(36, 7, '', 'ничего из перечисленного'),
(37, 8, '', 'футбол'),
(38, 8, '', 'волейбол'),
(39, 8, '', 'баскетбол'),
(40, 8, '', 'хоккей'),
(41, 8, '', 'легкая атлетика'),
(42, 8, '', 'большой теннис'),
(43, 8, '', 'настольный теннис'),
(44, 8, '', 'борьба, восточные единоборства'),
(45, 8, '', 'бокс'),
(46, 8, '', 'фитнес, аэробика'),
(47, 8, '', 'бодибилдинг, тренажерный зал'),
(48, 8, '', 'катание на коньках'),
(49, 8, '', 'беговые лыжи'),
(50, 8, '', 'горные лыжи, сноуборд'),
(51, 8, '', 'катание на велосипеде'),
(52, 8, '', 'катание на роликах'),
(53, 8, '', 'скейтборд'),
(54, 8, '', 'туризм'),
(55, 8, '', 'другие виды спорта'),
(56, 8, '', 'ничего из перечисленного'),
(196, 9, '', 'Мы все одинаковые'),
(197, 9, '', 'Я хочу хорошо проводить время с друзьями'),
(195, 9, '', 'Я всегда уделяю внимание тому, что делают другие люди'),
(194, 9, '', 'Моя семья помогает мне строить мое будущее'),
(192, 9, '', 'Моя семья всегда относится ко мне с большим уважением'),
(193, 9, '', 'Я должен защищать тех, кого люблю'),
(191, 9, '', 'Я всегда стараюсь поддержать близких в трудную минуту'),
(190, 9, '', 'Я скорее предпочту знакомое и проверенное новому и неизведанному'),
(189, 9, '', 'Меня окружает спокойствие, моя жизнь свободна от стресса'),
(188, 9, '', 'В жизни мне, прежде всего, необходим комфорт'),
(187, 9, '', 'Я верю, что нас оберегает и защищает сила, большая, чем мы сами'),
(186, 9, '', 'Мы живем в очень интересное время'),
(185, 9, '', 'Я стараюсь предвидеть возникающие препятствия настолько, насколько это возможно'),
(184, 9, '', 'Моя главная цель - гарантировать себе стабильность и защищенность в будущем'),
(183, 9, '', 'Будущее необходимо тщательно планировать'),
(182, 9, '', 'Я стремлюсь выделяться из толпы '),
(181, 9, '', 'Я всегда нахожу способ выразить себя, подчеркнуть свою индивидуальность'),
(180, 9, '', 'Я горжусь тем, чего достиг (достигла) в жизни'),
(179, 9, '', 'Идеи - это движущая сила любого общества'),
(178, 9, '', 'Я постоянно работаю над тем, чтобы упрочить свое положение в обществе'),
(177, 9, '', 'Некоторые люди заслуживают уважения больше, чем другие'),
(175, 9, '', 'Уважение нужно заслужить'),
(176, 9, '', 'Чтобы стать уважаемым человеком, нужно ставить перед собой все новые и новые цели и достигать их'),
(174, 9, '', 'Мы всегда рискуем, пробуя новое, но это стоит того'),
(173, 9, '', 'Добиться исполнения своей мечты можно, если много и упорно работать'),
(172, 9, '', 'Мы должны стараться выходить за границы своих возможностей'),
(167, 9, '', 'Жизнь полна интересных и удивительных вещей'),
(168, 9, '', 'От жизни нужно получать удовольствие, а не терпеть существующий порядок вещей'),
(169, 9, '', 'Я хочу взять от мира все, что он может предложить'),
(170, 9, '', 'Что бы вы ни делали, нужно стараться получать удовольствие от этого занятия'),
(171, 9, '', 'Каждый может сделать так, чтобы его мечты осуществились'),
(200, 10, '', 'Совершаете поездки на машине по городу'),
(199, 10, '', 'Смотрите телевизор'),
(198, 9, '', 'Я высоко ценю близкие отношения с людьми и люблю проводить время в компании своих друзей'),
(207, 10, '', 'Просматриваете сайты в Интернете со стационарного компьютера, например новостные сайты и т.п.'),
(206, 10, '', 'Заходите в социальные сети со смартфона'),
(205, 10, '', 'Заходите в социальные сети со стационарного компьютера.'),
(204, 10, '', 'Смотрите online-video (на YouTube, Vimeo и т.п.)'),
(203, 10, '', 'Покупаете / читаете журналы, газеты'),
(202, 10, '', 'Слушаете радио'),
(201, 10, '', 'Ездите на метро, в общественном транспорте'),
(220, 11, '', 'Joss (Джосс)'),
(219, 11, '', 'Iguana (Игуана)'),
(218, 11, '', 'Helly Hansen (Хелли Хансен)'),
(217, 11, '', 'Glissade (Глиссад)'),
(216, 11, '', 'Fila (Фила)'),
(215, 11, '', 'Diadora (Диадора)'),
(214, 11, '', 'Demix (Дэмикс)'),
(213, 11, '', 'Columbia (Коламбиа)'),
(212, 11, '', 'Colmar (Колмар)'),
(211, 11, '', 'Asics (Асикс)'),
(210, 11, '', 'Arena (Арена)'),
(209, 11, '', 'Adidas (Адидас)'),
(208, 10, '', 'Просматриваете сайты в Интернете со смартфона, например новостные сайты и т.п.'),
(231, 11, '', 'Sprandi (Спранди)'),
(230, 11, '', 'Speedo (Спидо)'),
(229, 11, '', 'Salomon (Саломон)'),
(228, 11, '', 'Reebok (Рибок)'),
(227, 11, '', 'Puma (Пума)'),
(226, 11, '', 'Outventure (Аутвенче)'),
(225, 11, '', 'O''Neil (О''Нейл)'),
(224, 11, '', 'Nike (Найк)'),
(223, 11, '', 'Luhta (Лухта)'),
(222, 11, '', 'Lotto (Лотто)'),
(221, 11, '', 'Kappa (Каппа)'),
(232, 11, '', 'Termit (Термит)'),
(233, 11, '', 'Umbro (Умбро)'),
(234, 11, '', 'Другая импортная'),
(235, 11, '', 'Другая российская'),
(236, 12, '', 'Adidas (Адидас)'),
(237, 12, '', 'Arena (Арена)'),
(238, 12, '', 'Asics (Асикс)'),
(239, 12, '', 'Colmar (Колмар)'),
(240, 12, '', 'Columbia (Коламбиа)'),
(241, 12, '', 'Demix (Дэмикс)'),
(242, 12, '', 'Diadora (Диадора)'),
(243, 12, '', 'Fila (Фила)'),
(244, 12, '', 'Glissade (Глиссад)'),
(245, 12, '', 'Helly Hansen (Хелли Хансен)'),
(246, 12, '', 'Iguana (Игуана)'),
(247, 12, '', 'Joss (Джосс)'),
(248, 12, '', 'Kappa (Каппа)'),
(249, 12, '', 'Lotto (Лотто)'),
(250, 12, '', 'Luhta (Лухта)'),
(251, 12, '', 'Nike (Найк)'),
(252, 12, '', 'O''Neil (О''Нейл)'),
(253, 12, '', 'Outventure (Аутвенче)'),
(254, 12, '', 'Puma (Пума)'),
(255, 12, '', 'Reebok (Рибок)'),
(256, 12, '', 'Salomon (Саломон)'),
(257, 12, '', 'Speedo (Спидо)'),
(258, 12, '', 'Sprandi (Спранди)'),
(259, 12, '', 'Termit (Термит)'),
(260, 12, '', 'Umbro (Умбро)'),
(261, 12, '', 'Другая импортная'),
(262, 12, '', 'Другая российская'),
(263, 13, '', 'Спортмастер'),
(264, 13, '', 'Adidas (Адидас)'),
(265, 13, '', 'Reebok (Рибок)'),
(266, 13, '', 'Nike (Найк)'),
(267, 13, '', 'Puma (Пума)'),
(268, 13, '', 'Декатлон'),
(269, 13, '', 'Columbia (Коламбия)'),
(270, 13, '', 'InterSport (Интерспорт)'),
(271, 13, '', 'Спортландия'),
(272, 13, '', 'Спортлэнд'),
(273, 13, '', 'Триал Спорт'),
(274, 13, '', 'Спорт + мода'),
(275, 13, '', 'Эпицентр'),
(276, 13, '', 'Кант'),
(277, 13, '', 'Альпиндустрия'),
(278, 13, '', 'Профи'),
(279, 13, '', 'Спорт Хит'),
(280, 13, '', 'Высшая лига'),
(281, 14, '', 'Спортмастер'),
(282, 14, '', 'Adidas (Адидас)'),
(283, 14, '', 'Reebok (Рибок)'),
(284, 14, '', 'Nike (Найк)'),
(285, 14, '', 'Puma (Пума)'),
(286, 14, '', 'Декатлон'),
(287, 14, '', 'Columbia (Коламбия)'),
(288, 14, '', 'InterSport (Интерспорт)'),
(289, 14, '', 'Спортландия'),
(290, 14, '', 'Спортлэнд'),
(291, 14, '', 'Триал Спорт'),
(292, 14, '', 'Спорт + мода'),
(293, 14, '', 'Эпицентр'),
(294, 14, '', 'Кант'),
(295, 14, '', 'Альпиндустрия'),
(296, 14, '', 'Профи'),
(297, 14, '', 'Спорт Хит'),
(298, 14, '', 'Высшая лига'),
(299, 14, '', 'Ничего из перечисленного'),
(300, 15, '', 'Одежда для спорта и фитнеса '),
(301, 15, '', 'Одежда для туризма и активного отдыха'),
(302, 15, '', 'Повседневная одежда спортивного стиля'),
(303, 15, '', 'Обувь для спорта и фитнеса '),
(304, 15, '', 'Обувь для туризма и активного отдыха'),
(305, 15, '', 'Обувь спортивного стиля'),
(306, 15, '', 'Горнолыжная / сноубордическая одежда'),
(307, 15, '', 'Товары для туризма и активного отдыха на природе'),
(308, 15, '', 'Товары для фитнеса (тренажеры, гантели, коврики и другое)'),
(309, 15, '', 'Велосипеды'),
(310, 15, '', 'Товары для плавания'),
(311, 15, '', 'Ледовые коньки'),
(312, 15, '', 'Роликовые коньки'),
(313, 15, '', 'Лыжи беговые'),
(314, 15, '', 'Лыжи горные'),
(315, 15, '', 'Сноуборды'),
(316, 15, '', 'Товары для игровых видов спорта (мячи, ракетки, клюшки и т.п.)'),
(317, 15, '', 'Товары и экипировка для единоборств (карате, бокс, дзюдо и т.п.)'),
(318, 15, '', 'Другие спортивные товары'),
(319, 16, '', 'Одежда для спорта и фитнеса '),
(320, 16, '', 'Одежда для туризма и активного отдыха'),
(321, 16, '', 'Повседневная одежда спортивного стиля'),
(322, 16, '', 'Обувь для спорта и фитнеса '),
(323, 16, '', 'Обувь для туризма и активного отдыха'),
(324, 16, '', 'Обувь спортивного стиля'),
(325, 16, '', 'Горнолыжная / сноубордическая одежда'),
(326, 16, '', 'Товары для туризма и активного отдыха на природе'),
(327, 16, '', 'Товары для фитнеса (тренажеры, гантели, коврики и другое)'),
(328, 16, '', 'Велосипеды'),
(329, 16, '', 'Товары для плавания'),
(330, 16, '', 'Ледовые коньки'),
(331, 16, '', 'Роликовые коньки'),
(332, 16, '', 'Лыжи беговые'),
(333, 16, '', 'Лыжи горные'),
(334, 16, '', 'Сноуборды'),
(335, 16, '', 'Товары для игровых видов спорта (мячи, ракетки, клюшки и т.п.)'),
(336, 16, '', 'Товары и экипировка для единоборств (карате, бокс, дзюдо и т.п.)'),
(338, 17, '', 'Одежда для спорта и фитнеса '),
(339, 17, '', 'Одежда для туризма и активного отдыха'),
(340, 17, '', 'Повседневная одежда спортивного стиля'),
(341, 17, '', 'Обувь для спорта и фитнеса '),
(342, 17, '', 'Обувь для туризма и активного отдыха'),
(343, 17, '', 'Обувь спортивного стиля'),
(344, 17, '', 'Горнолыжная / сноубордическая одежда'),
(345, 17, '', 'Товары для туризма и активного отдыха на природе'),
(346, 17, '', 'Товары для фитнеса (тренажеры, гантели, коврики и другое)'),
(347, 17, '', 'Велосипеды'),
(348, 17, '', 'Товары для плавания'),
(349, 17, '', 'Ледовые коньки'),
(350, 17, '', 'Роликовые коньки'),
(351, 17, '', 'Лыжи беговые'),
(352, 17, '', 'Лыжи горные'),
(353, 17, '', 'Сноуборды'),
(354, 17, '', 'Товары для игровых видов спорта (мячи, ракетки, клюшки и т.п.)'),
(355, 17, '', 'Товары и экипировка для единоборств (карате, бокс, дзюдо и т.п.)'),
(356, 17, '', 'Другие спортивные товары'),
(357, 18, '', 'Одежда для спорта и фитнеса '),
(358, 18, '', 'Одежда для туризма и активного отдыха'),
(359, 18, '', 'Повседневная одежда спортивного стиля'),
(360, 18, '', 'Обувь для спорта и фитнеса '),
(361, 18, '', 'Обувь для туризма и активного отдыха'),
(362, 18, '', 'Обувь спортивного стиля'),
(363, 18, '', 'Горнолыжная / сноубордическая одежда'),
(364, 18, '', 'Товары для туризма и активного отдыха на природе'),
(365, 18, '', 'Товары для фитнеса (тренажеры, гантели, коврики и другое)'),
(366, 18, '', 'Велосипеды'),
(367, 18, '', 'Товары для плавания'),
(368, 18, '', 'Ледовые коньки'),
(369, 18, '', 'Роликовые коньки'),
(370, 18, '', 'Лыжи беговые'),
(371, 18, '', 'Лыжи горные'),
(372, 18, '', 'Сноуборды'),
(373, 18, '', 'Товары для игровых видов спорта (мячи, ракетки, клюшки и т.п.)'),
(374, 18, '', 'Товары и экипировка для единоборств (карате, бокс, дзюдо и т.п.)'),
(375, 19, '', 'Спортмастер'),
(376, 19, '', 'Adidas (Адидас)'),
(377, 19, '', 'Reebok (Рибок)'),
(378, 19, '', 'Nike (Найк)'),
(379, 19, '', 'Puma (Пума)'),
(380, 19, '', 'Декатлон'),
(381, 19, '', 'Columbia (Коламбия)'),
(382, 19, '', 'InterSport (Интерспорт)'),
(383, 19, '', 'Спортландия'),
(384, 19, '', 'Спортлэнд'),
(385, 19, '', 'Триал Спорт'),
(386, 19, '', 'Спорт + мода'),
(387, 19, '', 'Эпицентр'),
(388, 19, '', 'Кант'),
(389, 19, '', 'Альпиндустрия'),
(390, 19, '', 'Профи'),
(391, 19, '', 'Спорт Хит'),
(392, 19, '', 'Высшая лига'),
(393, 20, '', 'Я - практичный человек'),
(394, 20, '', 'Деньги - лучший показатель успеха'),
(395, 20, '', 'Я очень хорошо распоряжаюсь деньгами'),
(396, 20, '', 'Я веду себя так, как мне нравится, не беспокоясь о мнении других людей'),
(397, 20, '', 'Важно быть хорошо информированным'),
(398, 20, '', 'Я не могу жить без приключений'),
(399, 20, '', 'Критика и замечания всегда очень задевают меня'),
(400, 20, '', 'Я с удовольствием хожу в театр, на концерты'),
(401, 20, '', 'Я не переношу, когда в доме не убрано'),
(402, 20, '', 'Временами представляется правильным не повиноваться закону'),
(403, 20, '', 'В своей карьере я хочу достичь самого высокого положения'),
(404, 20, '', 'Прежде, чем совершить покупки на неделю, я обдумываю, что я хочу'),
(405, 20, '', 'Я готов(а) пожертвовать семьей ради работы'),
(406, 20, '', 'Мне интересны люди и обычаи других культур'),
(407, 20, '', 'Мне нравится, когда другие считают, что мои финансовые дела идут успешно'),
(408, 20, '', 'Мне доставляет удовольствие заниматься организаторской деятельностью'),
(409, 20, '', 'Я скорее проведу спокойный вечер дома, чем пойду на вечеринку с компанией'),
(410, 20, '', 'Я не обращаю внимания на правила и условности, ограничивающие мою свободу'),
(411, 20, '', 'Сбережения нужно делать обязательно, даже отказывая себе в самом необходимом'),
(412, 20, '', 'Я люблю рисковать'),
(413, 20, '', 'Мне нравится быть хорошо организованным и следовать установленному порядку вещей'),
(414, 20, '', 'Я уверен(а), что смог(ла) бы основать свою собственную компанию'),
(415, 20, '', 'В моей семье я распоряжаюсь финансами'),
(416, 20, '', 'Мне нравится проводить время со своей семьей '),
(417, 20, '', 'Я восхищаюсь людьми, которые заработали достаточно, чтобы купить дорогую машину или квартиру'),
(418, 20, '', 'Интернет дает дополнительные преимущества для моей работы, для моего бизнеса'),
(419, 20, '', 'Когда мне нужна информация, первым делом я обращаюсь к интернету'),
(420, 20, '', 'Мне нравится попадать в новые и необычные ситуации'),
(421, 20, '', 'Мне нравится быть за рамками стандартов'),
(422, 20, '', 'Я внимательно читаю текст на упаковках, чтобы узнать состав продукта'),
(423, 20, '', 'Я люблю проводить свой отпуск, каникулы каждый раз на новом месте'),
(424, 20, '', 'Я люблю пользоваться новейшими приспособлениями и бытовой техникой'),
(425, 21, '', 'Пиво'),
(426, 21, '', 'Энергетические напитки'),
(427, 21, '', 'Слабоалкогольные коктейли (готовые)'),
(428, 21, '', 'Коньяк, бренди'),
(429, 21, '', 'Водку, горькие настойки'),
(430, 21, '', 'Вино'),
(431, 21, '', 'Йогурт (густой или питьевой)'),
(432, 21, '', 'Растворимый кофе'),
(433, 21, '', 'Кофе молотый, в зернах'),
(434, 21, '', 'Не пил(а) ничего из перечисленного'),
(435, 22, '', 'Да'),
(436, 22, '', 'Нет'),
(437, 23, '', 'Мужскую одежду'),
(438, 23, '', 'Женскую одежду'),
(439, 23, '', 'Мужское белье'),
(440, 23, '', 'Женское белье'),
(441, 23, '', 'Спортивную одежду'),
(442, 23, '', 'Не покупал(а) ничего из перечисленного'),
(443, 24, '', 'Эстрада 60-80 годов (зарубежная или советская), ретро музыка'),
(444, 24, '', 'Классическая музыка, оперная музыка'),
(445, 24, '', 'Современная поп-музыка (западная или отечественная)'),
(446, 24, '', 'Этническая музыка, фольклор'),
(447, 24, '', 'Рэп, хип-хоп, электронная музыка'),
(448, 24, '', 'Русский шансон, блатная песня'),
(449, 24, '', 'Рок, рок-н-ролл, хард-рок, альтернатива'),
(450, 24, '', 'Другая музыка'),
(451, 24, '', 'Не слушаю музыку'),
(452, 25, '', 'Театр'),
(453, 25, '', 'Кинотеатр'),
(454, 25, '', 'Ночной клуб'),
(455, 25, '', 'Эстрадный концерт, вечер юмора'),
(456, 25, '', 'Концерт классической или джазовой музыки'),
(457, 25, '', 'Дискотеку'),
(458, 25, '', 'Музей, галерею'),
(459, 25, '', 'Не посещал(а) ничего из перечисленного'),
(460, 26, '', 'Да'),
(461, 26, '', 'Нет'),
(462, 27, '', 'Читали журналы'),
(463, 27, '', 'Читали газеты'),
(464, 27, '', 'Пользовались Интернетом'),
(465, 27, '', 'Ничего из перечисленного'),
(466, 28, '', 'Фитнес-клуб, тренажерный зал'),
(467, 28, '', 'Салон красоты'),
(468, 28, '', 'Косметический салон'),
(469, 28, '', 'Кафе, кофейни'),
(470, 28, '', 'Суши-бар, суши-ресторан'),
(471, 28, '', 'Другой ресторан, бар'),
(472, 28, '', 'Ничего из перечисленного'),
(473, 29, '', 'Велосипед'),
(474, 29, '', 'Лыжи'),
(475, 29, '', 'Фигурные или хоккейные коньки'),
(476, 29, '', 'Роликовые коньки'),
(477, 29, '', 'Велотренажер'),
(478, 29, '', 'Беговая дорожка'),
(479, 29, '', 'Силовой тренажер'),
(480, 29, '', 'Другие виды тренажеров'),
(481, 29, '', 'Туристическая палатка, тент'),
(482, 29, '', 'Ничего из перечисленного'),
(483, 30, '', 'Поездки по России или СНГ'),
(484, 30, '', 'Поездки за пределы России и СНГ'),
(485, 30, '', 'Ничего из перечисленного'),
(486, 31, '', 'Да'),
(487, 31, '', 'Нет'),
(488, 32, '', 'Нам не хватает денег даже на еду'),
(489, 32, '', 'У нас хватает денег на еду, но для покупки одежды надо откладывать деньги заранее'),
(490, 32, '', 'Хватает денег на еду и одежду, но не можем покупать дорогие вещи'),
(491, 32, '', 'Можем покупать дорогие вещи, но не все, что захотим'),
(492, 32, '', 'Полный достаток, не ограничены в средствах'),
(493, 32, '', 'Отказ от ответа');

-- --------------------------------------------------------

--
-- Структура таблицы `conditions`
--

DROP TABLE IF EXISTS `conditions`;
CREATE TABLE IF NOT EXISTS `conditions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qId` int(10) UNSIGNED NOT NULL,
  `cond` varchar(255) NOT NULL,
  `relatedQId` int(10) UNSIGNED NOT NULL,
  `relationType` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `step_id` (`qId`,`relatedQId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `conditions`
--

INSERT INTO `conditions` (`id`, `qId`, `cond`, `relatedQId`, `relationType`) VALUES
(1, 1, '1', 2, 'next'),
(2, 2, '1', 3, 'next'),
(3, 2, '1', 1, 'prev'),
(4, 3, '1', 4, 'next'),
(5, 3, '1', 2, 'prev'),
(6, 4, '1', 5, 'next'),
(7, 4, '1', 3, 'prev'),
(8, 5, 'if B2=1', 6, 'next'),
(9, 5, 'if B2=2', 7, 'next'),
(10, 5, '1', 4, 'next');

-- --------------------------------------------------------

--
-- Структура таблицы `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `answerId` int(10) UNSIGNED NOT NULL,
  `qId` int(10) UNSIGNED NOT NULL,
  `respId` int(10) UNSIGNED NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `data`
--

INSERT INTO `data` (`id`, `answerId`, `qId`, `respId`, `answer`) VALUES
(1, 1, 1, 1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qNum` varchar(255) DEFAULT NULL,
  `qText` varchar(255) DEFAULT NULL,
  `qType` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `qNum`, `qText`, `qType`) VALUES
(1, 'S1', 'Пожалуйста, представьтесь:', 'multiple'),
(2, 'S2', 'Отметьте Ваш пол:', 'single'),
(3, 'B1', 'Впишите число полных лет цифрами', NULL),
(4, 'S3', 'Ваше семейное положение', NULL),
(5, 'В2', 'Есть ли у Вас лично дети до 18 лет, проживающие вместе с Вами?', NULL),
(6, 'В3', 'Скажите, сколько у Вас детей?', NULL),
(7, 'C8', 'Какими из перечисленных видов спорта Вы лично занимались в последнее время?', NULL),
(8, 'C8A', 'Вы сказали, что занимаетесь следующими видами спорта: ... как часто Вы занимаетесь каждым из них?', NULL),
(9, 'С13', 'Оцените, насколько Вы согласны с каждым из высказываний по пятибалльной шкале, где 1 – полностью не согласен, а 5 – полностью согласен.', NULL),
(10, 'M1', 'Что из перечисленного вы делаете регулярно?', NULL),
(11, 'Q1-6', 'Какое из перечисленных высказываний лучше всего описывает Ваше отношение к каждой из следующих марок спортивных товаров?', NULL),
(12, 'Q7', 'Спортивные товары каких марок Вы никогда не будете покупать?', NULL),
(13, 'Q8-13', 'Какое из перечисленных высказываний лучше всего описывает Ваше отношение к каждому из следующих спортивных магазинов? ', NULL),
(14, 'Q14', 'В каких из перечисленных магазинов спортивных товаров Вы никогда не будете делать покупки?', NULL),
(15, 'Q15', 'Скажите, что из перечисленного Вы покупали лично для себя за последний год?', NULL),
(16, 'Q16', 'Скажите, сколько раз за последний год вы покупали каждый из следующих товаров лично для себя?', NULL),
(17, 'Q15A', 'Скажите, что из перечисленного Вы покупали для своего ребенка за последний год?', NULL),
(18, 'Q16A', 'Скажите, сколько раз за последний год вы покупали каждый из следующих товаров для своего ребенка?', NULL),
(19, 'Q17', 'Вы сказали, что делаете покупки в спортивных магазинах ... Подумайте о Ваших последних 10 поках спортивных товаров, включая спортивную одежду и обувь. Вспомните, как распределились Ваши покупки между этими спортивными магазинами?', NULL),
(20, 'Q18', 'Оцените, насколько Вы согласны с каждым из высказываний по пятибалльной шкале, где 1 – полностью не согласен, а 5 – полностью согласен.', NULL),
(21, 'С1', 'Что из перечисленного Вы потребляли хотя бы раз за последние 3 месяца?', NULL),
(22, 'С2', 'Курите ли Вы хотя бы иногда сигареты?', NULL),
(23, 'С3', 'Что из перечисленного Вы покупали хотя бы раз за последние 6 месяцев?', NULL),
(24, 'С4', 'Музыку каких стилей Вы слушаете чаще всего?', NULL),
(25, 'С5', 'Что из перечисленного Вы посещали за последние 6 месяцев?', NULL),
(26, 'С6', 'Водите ли Вы лично автомобиль?', NULL),
(27, 'С7', 'Что из перечисленного Вы делали за последнюю неделю?', NULL),
(28, 'С9', 'Что из перечисленного Вы посещали за последние 3 месяца?', NULL),
(29, 'С10', ' Что из перечисленного есть в Вашей семье?', NULL),
(30, 'С11', 'Какие поездки Вы совершали за последние 12 месяцев?', NULL),
(31, 'С12', 'Есть ли у Вашей семьи дача, дачный участок?', NULL),
(32, 'СD3', 'Скажите, пожалуйста, как бы Вы охарактеризовали уровень доходов Вашей семьи? Выберите, пожалуйста, один наиболее подходящий вариант из перечисленных.', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `respondents`
--

DROP TABLE IF EXISTS `respondents`;
CREATE TABLE IF NOT EXISTS `respondents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `respondents`
--

INSERT INTO `respondents` (`id`, `start`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `scales`
--

DROP TABLE IF EXISTS `scales`;
CREATE TABLE IF NOT EXISTS `scales` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qId` int(10) UNSIGNED NOT NULL,
  `scaleText` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `scales`
--

INSERT INTO `scales` (`id`, `qId`, `scaleText`) VALUES
(1, 8, '3 раза в неделю и чаще'),
(2, 8, '1-2 раза в неделю'),
(3, 8, '1-2 раза в месяц'),
(4, 8, '2-3 раза в полгода'),
(5, 8, '1 раз в год и реже'),
(6, 9, 'Абсолютно НЕ согласен'),
(7, 9, '2'),
(8, 9, '3'),
(9, 9, '4'),
(10, 9, 'Полностью согласен'),
(11, 13, 'Я покупаю спортивную одежду и/или обувь только в этом магазине'),
(12, 13, 'Я покупаю спортивную одежду и/или обувь в этом магазине наряду с другими магазинами'),
(13, 13, 'У меня был опыт покупки спортивной одежды и/или обуви в этом магазине, но сейчас я не делаю покупки там'),
(14, 13, 'Я видел(а) такие магазины /я был(a) в магазинах этой сети, но никогда ничего не покупал(а) там'),
(15, 13, 'Я знаю о существовании магазинов этой сети, но никогда не видел(а) их и не бывал там'),
(16, 13, 'Я никогда не видел(а) и не слышал(а) ничего о магазинах с таким названием раньше'),
(17, 16, 'Один раз'),
(18, 16, 'Два раза'),
(19, 16, 'Три раза'),
(20, 16, 'Четыре раза'),
(21, 16, 'Пять раз и чаще'),
(22, 18, 'Один раз'),
(23, 18, 'Два раза'),
(24, 18, 'Три раза'),
(25, 18, 'Четыре раза'),
(26, 18, 'Пять раз и чаще'),
(27, 20, 'Абсолютно НЕ согласен 1'),
(28, 20, '2'),
(29, 20, '3'),
(30, 20, '4'),
(31, 20, 'Полностью согласен 5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;