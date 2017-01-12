
CREATE TABLE `api_key` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `apikey` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `client_payment_details` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `related_user` int(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `trading_name` varchar(128) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `coord_lat` decimal(10,8) DEFAULT NULL,
  `coord_long` decimal(10,8) DEFAULT NULL,
  `created` datetime NOT NULL,
  `closed` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT '',
  `opening_hours` varchar(255) DEFAULT '',
  `photo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `company_design` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `key_` varchar(255) NOT NULL,
  `value_` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `employee_payment_details` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `emp_description` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `goodcode` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `goodcode` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `main_score` int(11) DEFAULT NULL,
  `param2_score` int(11) DEFAULT NULL,
  `param3_score` int(11) DEFAULT NULL,
  `submitted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `rel_employee_company` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `status` enum('pending','none','active','declined') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `datestamp` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `revoked` varchar(255) DEFAULT NULL,
  `rel_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `auth` varchar(255) DEFAULT NULL,
  `role` enum('employee','client','employer') DEFAULT NULL,
  `created` datetime NOT NULL,
  `closed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `api_key`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `client_payment_details`
--
ALTER TABLE `client_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_user` (`related_user`);

--
-- Indexes for table `company_design`
--
ALTER TABLE `company_design`
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `employee_payment_details`
--
ALTER TABLE `employee_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `emp_description`
--
ALTER TABLE `emp_description`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `employee_id_2` (`employee_id`);

--
-- Indexes for table `goodcode`
--
ALTER TABLE `goodcode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `goodcode` (`goodcode`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `rel_employee_company`
--
ALTER TABLE `rel_employee_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_raiting` (`rel_rating`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_key`
--
ALTER TABLE `api_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `client_payment_details`
--
ALTER TABLE `client_payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `employee_payment_details`
--
ALTER TABLE `employee_payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_description`
--
ALTER TABLE `emp_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `goodcode`
--
ALTER TABLE `goodcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `rel_employee_company`
--
ALTER TABLE `rel_employee_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_key`
--
ALTER TABLE `api_key`
  ADD CONSTRAINT `api_key_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_payment_details`
--
ALTER TABLE `client_payment_details`
  ADD CONSTRAINT `client_payment_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_related_user` FOREIGN KEY (`related_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `company_design`
--
ALTER TABLE `company_design`
  ADD CONSTRAINT `company_design_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `employee_payment_details`
--
ALTER TABLE `employee_payment_details`
  ADD CONSTRAINT `employee_payment_details_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `emp_description`
--
ALTER TABLE `emp_description`
  ADD CONSTRAINT `emp_description_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `goodcode`
--
ALTER TABLE `goodcode`
  ADD CONSTRAINT `suhe` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `rating_by_client` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rating_for_employee` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `rel_employee_company`
--
ALTER TABLE `rel_employee_company`
  ADD CONSTRAINT `rel company to employee` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rel_employee_company_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
