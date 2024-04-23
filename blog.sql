CREATE TABLE `blog` (
  `id` int NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `date_posted`) VALUES
(3, 'My first blog!', 'The answer was within her reach. It was hidden in a box and now that box sat directly in front of her. She\'d spent years searching for it and could hardly believe she\'d finally managed to find it. She turned the key to unlock the box and then gently lifted the top. She held her breath in anticipation of finally knowing the answer she had spent so much of her time in search of. As the lid came off she could see that the box was empty. The alarm went off at exactly 6:00 AM as it had every morning for the past five years. Barbara began her morning and was ready to eat breakfast by 7:00 AM. The day appeared to be as normal as any other, but that was about to change. In fact, it was going to change at exactly 7:23 AM. If you can imagine a furry humanoid seven feet tall, with the face of an intelligent gorilla and the braincase of a man, you\'ll have a rough idea of what they looked like -- except for their teeth. The canines would have fitted better in the face of a tiger, and showed at the corners of their wide, thin-lipped mouths, giving them an expression of ferocity. ', '2023-09-27 05:28:21'),
(4, 'Maybe second blog', 'The river slowly meandered through the open space. It had hidden secrets that it didn\'t want to reveal. It had a well-planned strategy to appear calm, inviting, and appealing. That\'s how the river lured her unknowing victims to her water\'s edge.', '2023-09-27 05:28:21'),
(5, 'Another one - DJ Khaled', 'He took a sip of the drink. He wasn\'t sure whether he liked it or not, but at this moment it didn\'t matter. She had made it especially for him so he would have forced it down even if he had absolutely hated it. That\'s simply the way things worked. She made him a new-fangled drink each day and he took a sip of it and smiled, saying it was excellent.\r\nSleep deprivation causes all sorts of challenges and problems. When one doesn’t get enough sleep one’s mind doesn’t work clearly. Studies have shown that after staying awake for 24 hours one’s ability to do simple math is greatly impaired. Driving tired has been shown to be as bad as driving drunk. Moods change, depression, anxiety, and mania can be induced by lack of sleep. As much as people try to do without enough sleep it is a wonder more crazy things don’t happen in this world.', '2023-09-27 08:56:38'),
(6, 'Do dragons exist', 'Dragons don\'t exist they said. They are the stuff of legend and people\'s imagination. Greg would have agreed with this assessment without a second thought 24 hours ago. But now that there was a dragon staring directly into his eyes, he questioned everything that he had been told.', '2023-09-27 08:57:38'),
(7, 'What is this Ford craze!', 'There wasn\'t a whole lot more that could be done. It had become a wait-and-see situation with the final results no longer in her control. That didn\'t stop her from trying to control the situation. She demanded that things be done as she desperately tried to control what couldn\'t be.\r\nHe was after the truth. At least, that\'s what he told himself. He believed it, but any rational person on the outside could see he was lying to himself. It was apparent he was really only after his own truth that he\'d already decided and was after this truth because the facts didn\'t line up with the truth he wanted. So he continued to tell everyone he was after the truth oblivious to the real truth sitting right in front of him.', '2023-09-27 08:58:38'),
(8, 'How to ignore the BMW haters', 'Sometimes it\'s simply better to ignore the haters. That\'s the lesson that Tom\'s dad had been trying to teach him, but Tom still couldn\'t let it go. He latched onto them and their hate and couldn\'t let it go, but he also realized that this wasn\'t healthy. That\'s when he came up with his devious plan.', '2023-09-27 09:00:15'),
(9, 'randomedit', 'Why do Americans have so many different types of towels? We have beach towels, hand towels, bath towels, dish towels, camping towels, quick-dry towels, and let&rsquo;s not forget paper towels. Would 1 type of towel work for each of these things? Let&rsquo;s take a beach towel. It can be used to dry your hands and body with no difficulty. A beach towel could be used to dry dishes. Just think how many dishes you could dry with one beach towel. I&rsquo;ve used a beach towel with no adverse effects while camping. If you buy a thin beach towel it can dry quickly too. I&rsquo;d probably cut up a beach towel to wipe down counters or for cleaning other items, but a full beach towel could be used too. Is having so many types of towels an extravagant luxury that Americans enjoy or is it necessary? I&rsquo;d say it&#039;s overkill and we could cut down on the many types of towels that manufacturers deem necessary.\r\nHave you ever wondered about toes? Why 10 toes and not 12. Why are some bigger than others? Some people can use their toes to pick up things while others can barely move them on command. Some toes are nice to look at while others are definitely not something you want to look at. Toes can be stubbed and make us scream. Toes help us balance and walk. 10 toes are just something to ponder.\r\n&quot;It&#039;s never good to give them details,&quot; Janice told her sister. &quot;Always be a little vague and keep them guessing.&quot; Her sister listened intently and nodded in agreement. She didn&#039;t fully understand what her sister was saying but that didn&#039;t matter. She loved her so much that she would have agreed to whatever came out of her mouth.\r\nThe light blinded him. It was dark and he thought he was the only one in the area, but the light shining in his eyes proved him wrong. It came from about 100 feet away and was shining so directly into his eyes he couldn&#039;t make out anything about the person holding the light. There was only one thing to do in this situation. He reached into his pocket and pulled out a flashlight of his own that was much stronger than the one currently blinding him. He turned it on and pointed it into the stranger&#039;s eyes.', '2023-09-27 19:37:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

