-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-14 04:56:08
-- サーバのバージョン： 10.4.13-MariaDB
-- PHP のバージョン: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `shineva`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `block`
--

CREATE TABLE `block` (
  `user_id` int(11) NOT NULL,
  `blockoppoment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `follow`
--

CREATE TABLE `follow` (
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `like_ip`
--

CREATE TABLE `like_ip` (
  `thread_id` int(11) NOT NULL,
  `colume_id` int(11) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `mute`
--

CREATE TABLE `mute` (
  `thread_id` int(11) NOT NULL,
  `colume_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `pf`
--

CREATE TABLE `pf` (
  `user_id` int(20) NOT NULL,
  `selfintro` text COLLATE utf8_bin NOT NULL,
  `job` varchar(30) COLLATE utf8_bin NOT NULL,
  `gender` enum('male','female','other') COLLATE utf8_bin NOT NULL,
  `img` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `pf`
--

INSERT INTO `pf` (`user_id`, `selfintro`, `job`, `gender`, `img`) VALUES
(1000, 'Benjamin Maximillian Mehl (November 5, 1884 – September 28, 1957), usually known as B. Max Mehl, was an American dealer in coins, selling them for over half a century. The most prominent dealer in the U.S. through much of the first half of the 20th century, he is credited with helping to expand the appeal of coin collecting from a hobby for the wealthy to one enjoyed by many.\r\n\r\nMehl was born in Congress Poland, which was part of the Russian Empire. His family brought him to what is now Lithuania, and then to the United States, settling in Fort Worth, Texas, where he lived for almost all of his adult life. While still a teenager, he began to sell coins, which he had previously collected. Joining the American Numismatic Association (ANA) in 1903 at age 18, he quickly became a full-time coin dealer, and by 1910 was one of the most well-known in the country.', 'engenieer', 'female', 'profile.png'),
(1001, 'dfkjhgfdfjjg', 'dfghjk', 'female', 'profile.png');

-- --------------------------------------------------------

--
-- テーブルの構造 `threadno1000000`
--

CREATE TABLE `threadno1000000` (
  `colume_id` int(11) NOT NULL,
  `user_name` char(20) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `posttime` datetime NOT NULL,
  `like_cnt` int(11) DEFAULT NULL,
  `anonymous` enum('t','f') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `threadno1000000`
--

INSERT INTO `threadno1000000` (`colume_id`, `user_name`, `user_id`, `content`, `posttime`, `like_cnt`, `anonymous`) VALUES
(1, 'ryu', 0, 'なんでことはなかったわ', '2021-11-25 13:29:14', 0, 'f'),
(2, 'ryu', 0, 'floot 2 test', '2021-11-25 13:59:05', 0, 't'),
(3, 'ryu', 0, '1979年10月26日の金載圭が起した朴正煕暗殺事件の後、崔圭夏が大統領に就任していたが、程なく韓国軍戒厳司令部合同捜査本部長の全斗煥将軍が12月12日の粛軍クーデターで韓国軍を掌握し、盧泰愚を中心とする新軍部勢力と共に実質的な権限を握った。この間、独裁的な政府の支配に対する強硬な抗議の声が市民社会の間から現れ、主に大学生と労働組合によって為される抗議活動が、大規模デモによって最高潮に達した。そのため全将軍は、1980年5月17日に戒厳令を布告して民主化運動の取り締まりにかかり、金大中、金鍾泌といった有力な政治家を拘束した（5・17非常戒厳令拡大措置）。更に5月18日に発生した光州事件では、学生らの抵抗に対し軍事力を用いた徹底的な弾圧を行なった。\r\n\r\n軍部の圧力によって、1980年8月16日に崔圭夏が大統領を辞任すると、公式的な憲法手続きによって、8月27日に全斗煥が第11代大統領に就任した。その後、10月27日の憲法改正案を巡る国民投票で、大統領の任期7年化と再選禁止を定めるなど大幅な改変を施しつつも、維新憲法的な色彩を残した第五共和国憲法が採択・制定された。そして、第5共和国憲法に基づき、1981年3月3日に全斗煥が第12代大統領に就任することで、本格的な第五共和国が成立した。\r\n\r\n統治機構の特徴1979年10月26日の金載圭が起した朴正煕暗殺事件の後、崔圭夏が大統領に就任していたが、程なく韓国軍戒厳司令部合同捜査本部長の全斗煥将軍が12月12日の粛軍クーデターで韓国軍を掌握し、盧泰愚を中心とする新軍部勢力と共に実質的な権限を握った。この間、独裁的な政府の支配に対する強硬な抗議の声が市民社会の間から現れ、主に大学生と労働組合によって為される抗議活動が、大規模デモによって最高潮に達した。そのため全将軍は、1980年5月17日に戒厳令を布告して民主化運動の取り締まりにかかり、金大中、金鍾泌といった有力な政治家を拘束した（5・17非常戒厳令拡大措置）。更に5月18日に発生した光州事件では、学生らの抵抗に対し軍事力を用いた徹底的な弾圧を行なった。\r\n\r\n軍部の圧力によって、1980年8月16日に崔圭夏が大統領を辞任すると、公式的な憲法手続きによって、8月27日に全斗煥が第11代大統領に就任した。その後、10月27日の憲法改正案を巡る国民投票で、大統領の任期7年化と再選禁止を定めるなど大幅な改変を施しつつも、維新憲法的な色彩を残した第五共和国憲法が採択・制定された。そして、第5共和国憲法に基づき、1981年3月3日に全斗煥が第12代大統領に就任することで、本格的な第五共和国が成立した。\r\n\r\n統治機構の特徴', '2021-11-25 13:59:05', 0, 'f'),
(4, 'ryu', 0, 'floot 2 test', '2021-11-25 13:59:05', 0, 'f'),
(5, 'ryu', 0, '1979年10月26日の金載圭が起した朴正煕暗殺事件の後、崔圭夏が大統領に就任していたが、程なく韓国軍戒厳司令部合同捜査本部長の全斗煥将軍が12月12日の粛軍クーデターで韓国軍を掌握し、盧泰愚を中心とする新軍部勢力と共に実質的な権限を握った。この間、独裁的な政府の支配に対する強硬な抗議の声が市民社会の間から現れ、主に大学生と労働組合によって為される抗議活動が、大規模デモによって最高潮に達した。そのため全将軍は、1980年5月17日に戒厳令を布告して民主化運動の取り締まりにかかり、金大中、金鍾泌といった有力な政治家を拘束した（5・17非常戒厳令拡大措置）。更に5月18日に発生した光州事件では、学生らの抵抗に対し軍事力を用いた徹底的な弾圧を行なった。\r\n\r\n軍部の圧力によって、1980年8月16日に崔圭夏が大統領を辞任すると、公、1980年8月16日に崔圭夏が大統領を辞任すると、公式的な憲法手続きによって、8月27日に全斗煥が第11代大統領に就任した。その後、10月27日の憲法改正案を巡る国民投票で、大統領の任期7年化と再選禁止を定めるなど大幅な改変を施しつつも、維新憲法的な色彩を残した第五共和国憲法が採択・制定された。そして、第5共和国憲法に基づき、1981年3月3日に全斗煥が第12代大統領に就任することで、本格的な第五共和国が成立した。\r\n\r\n統治機構の特徴', '2021-11-25 13:59:05', 0, 'f');

-- --------------------------------------------------------

--
-- テーブルの構造 `threadno1000001`
--

CREATE TABLE `threadno1000001` (
  `colume_id` int(11) NOT NULL,
  `user_name` char(20) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `posttime` datetime NOT NULL,
  `like_cnt` int(11) DEFAULT NULL,
  `anonymous` enum('t','f') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `threadno1000001`
--

INSERT INTO `threadno1000001` (`colume_id`, `user_name`, `user_id`, `content`, `posttime`, `like_cnt`, `anonymous`) VALUES
(1, 'ryu', 0, '特に出会っただから', '2021-11-25 13:34:14', 0, 'f');

-- --------------------------------------------------------

--
-- テーブルの構造 `threadno1000002`
--

CREATE TABLE `threadno1000002` (
  `colume_id` int(11) NOT NULL,
  `user_name` char(20) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `posttime` datetime NOT NULL,
  `like_cnt` int(11) DEFAULT NULL,
  `anonymous` enum('t','f') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `threadno1000002`
--

INSERT INTO `threadno1000002` (`colume_id`, `user_name`, `user_id`, `content`, `posttime`, `like_cnt`, `anonymous`) VALUES
(1, 'ryu', 0, 'Solaris is a 1961 science fiction novel by Polish ...', '2021-11-25 13:34:14', 0, 'f'),
(2, 'Shikizakura(Public)', 1002, 'dsdsadsadd', '2022-01-14 12:25:22', 0, 'f');

-- --------------------------------------------------------

--
-- テーブルの構造 `threadno1000003`
--

CREATE TABLE `threadno1000003` (
  `colume_id` int(11) NOT NULL,
  `user_name` char(20) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `posttime` datetime NOT NULL,
  `like_cnt` int(11) DEFAULT NULL,
  `anonymous` enum('t','f') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `threadno1000003`
--

INSERT INTO `threadno1000003` (`colume_id`, `user_name`, `user_id`, `content`, `posttime`, `like_cnt`, `anonymous`) VALUES
(1, 'ryu', 0, '第五共和国（だいごきょうわこく）は、1981年3月から1988年2月の第六共和国成立までの間、大韓民国で存続した政体。この間、大統領に就任した全斗煥が、朴正煕の経済政策を引き継ぐ一方で大規模な体制改革を実施し、第六共和国の比較的安定した民主政治システムの基礎を築いた。', '2021-11-25 13:37:58', 0, 't'),
(3, 'dd', 0, '大阪', '2021-12-13 00:00:00', 0, 't');

-- --------------------------------------------------------

--
-- テーブルの構造 `trd`
--

CREATE TABLE `trd` (
  `thread_id` int(11) NOT NULL,
  `thread_name` char(20) COLLATE utf8_bin NOT NULL,
  `user_name` char(20) COLLATE utf8_bin NOT NULL,
  `category` char(15) COLLATE utf8_bin NOT NULL,
  `posttime` datetime NOT NULL,
  `last_post_time` datetime NOT NULL,
  `thread_intro` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `trd`
--

INSERT INTO `trd` (`thread_id`, `thread_name`, `user_name`, `category`, `posttime`, `last_post_time`, `thread_intro`) VALUES
(1000000, '初めてのルーブルは', 'ryu', 'test', '2021-11-25 13:29:14', '2021-11-25 13:29:14', 'なんでことはなかったわ'),
(1000001, '私だけのモナリザ', 'ryu', 'test', '2021-11-25 13:34:13', '2021-11-25 13:34:13', '特に出会っただから'),
(1000002, '「Solaris」', 'ryu', 'test', '2021-11-25 13:34:13', '2021-11-25 13:34:13', 'Solaris is a 1961 science fiction novel by Polish writer Stanisław Lem. It follows a crew of scientists on a research station as they attempt to understand ...'),
(1000003, '「第五共和国」', 'ryu', '', '2021-11-25 13:37:52', '2021-11-25 13:37:52', '第五共和国（だいごきょうわこく）は、1981年3月から1988年2月の第六共和国成立までの間、大韓民国で存続した政体。この間、大統領に就任した全斗煥が、朴正煕の経済政策を引き継ぐ一方で大規模な体制改革を実施し、第六共和国の比較的安定した民主政治システムの基礎を築いた。'),
(1000004, 'test123', 'Shikizakura', '', '2022-01-12 09:59:51', '2022-01-12 09:59:51', 'test123'),
(1000005, 'ãƒ†ã‚¹ãƒˆ', 'Shikizakura(Private)', '', '2022-01-12 10:05:15', '2022-01-12 10:29:59', 'ãƒ†ã‚¹ãƒˆ'),
(1000006, 'ãƒ†ã‚¹ãƒˆ', 'Shikizakura(Public)', 'entertainment', '2022-01-12 10:13:27', '2022-01-12 10:13:27', 'ãƒ†ã‚¹ãƒˆ'),
(1000007, 'ãƒ†ã‚¹ãƒˆ', 'Shikizakura(Private)', '', '2022-01-12 11:03:55', '2022-01-12 11:03:55', 'ãƒ†ã‚¹ãƒˆ'),
(1000008, 'ãƒ†ã‚¹ãƒˆ', 'Shikizakura(Private)', '', '2022-01-12 11:03:56', '2022-01-12 11:03:56', 'ãƒ†ã‚¹ãƒˆ'),
(1000009, 'ãƒ†ã‚¹ãƒˆ', 'Shikizakura(Private)', '', '2022-01-12 11:03:56', '2022-01-12 11:03:56', 'ãƒ†ã‚¹ãƒˆ'),
(1000010, 'test', 'Shikizakura(Public)', 'entertainment', '2022-01-12 11:38:48', '2022-01-12 11:38:48', 'test'),
(1000011, 'test', 'Shikizakura(Public)', 'entertainment', '2022-01-12 11:38:49', '2022-01-12 11:38:49', 'test'),
(1000012, 'test', 'Shikizakura(Public)', 'entertainment', '2022-01-12 11:38:49', '2022-01-12 11:38:49', 'test'),
(1000013, 'test', 'Shikizakura(Public)', 'entertainment', '2022-01-12 11:39:21', '2022-01-12 11:39:21', 'test'),
(1000014, 'test', 'Shikizakura(Public)', 'entertainment', '2022-01-12 11:39:21', '2022-01-12 11:39:21', 'test');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_kihon`
--

CREATE TABLE `user_kihon` (
  `user_id` int(20) NOT NULL,
  `e_mail` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `password` char(200) COLLATE utf8_bin DEFAULT NULL,
  `user_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `sign_in` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `user_kihon`
--

INSERT INTO `user_kihon` (`user_id`, `e_mail`, `password`, `user_name`, `sign_in`) VALUES
(1000, 'dondcyan@gmail.com', '04b45b4f2788fc9e267630609066fa5dde66e277bd679196440facd6da1dfd9d', 'ryu', '2021-11-25 13:10:54'),
(1001, '193125@ocsjoho.onmicrosoft.com', 'c3ff6decb2b284270f13288e07ec7a4a6b38dbc903da4d89c6ead2975e942bca', 'ABC', '2021-12-13 00:00:00'),
(1002, '193119@ocsjoho.onmicrosoft.com', 'af0859a6fc7b80b246636cbcec55d4a3b79e8d667b63e35a68b798ea041c06b2', 'Shikizakura(Public)', '2022-01-12 00:00:00'),
(1003, 'seaomuraisuck1204@gmail.com', '56e526579c1ede05161f90f0398e6cf8b0815335980199181c0b88a7334bc566', 'Shikizakura(Private)', '2022-01-12 00:00:00');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `pf`
--
ALTER TABLE `pf`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- テーブルのインデックス `threadno1000000`
--
ALTER TABLE `threadno1000000`
  ADD PRIMARY KEY (`colume_id`);

--
-- テーブルのインデックス `threadno1000001`
--
ALTER TABLE `threadno1000001`
  ADD PRIMARY KEY (`colume_id`);

--
-- テーブルのインデックス `threadno1000002`
--
ALTER TABLE `threadno1000002`
  ADD PRIMARY KEY (`colume_id`);

--
-- テーブルのインデックス `threadno1000003`
--
ALTER TABLE `threadno1000003`
  ADD PRIMARY KEY (`colume_id`);

--
-- テーブルのインデックス `trd`
--
ALTER TABLE `trd`
  ADD PRIMARY KEY (`thread_id`);

--
-- テーブルのインデックス `user_kihon`
--
ALTER TABLE `user_kihon`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `threadno1000000`
--
ALTER TABLE `threadno1000000`
  MODIFY `colume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `threadno1000001`
--
ALTER TABLE `threadno1000001`
  MODIFY `colume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルのAUTO_INCREMENT `threadno1000002`
--
ALTER TABLE `threadno1000002`
  MODIFY `colume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルのAUTO_INCREMENT `threadno1000003`
--
ALTER TABLE `threadno1000003`
  MODIFY `colume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `trd`
--
ALTER TABLE `trd`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000040;

--
-- テーブルのAUTO_INCREMENT `user_kihon`
--
ALTER TABLE `user_kihon`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `pf`
--
ALTER TABLE `pf`
  ADD CONSTRAINT `pf_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_kihon` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
