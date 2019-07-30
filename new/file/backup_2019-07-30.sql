CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'active,pending,blocked',
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'developer,administrator,moderator,etc.',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'active,pending,blocked',
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 
 
INSERT INTO `admins` ( `id`, `name`, `email`, `password`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES 
('2', 'Admin', 'admin@email.com', '$2y$10$k38by5CTWTuO67j7oYamP.bU4YWhBm5uDFBZa8xhJrDy2flOHRfoa', 'active', 'administrator', 'fhZ36KY0yDwcBGgTko8EkD0ijYngiMRhjs1k9SOmRZT65qzaU0Aus5b81KjX', '2019-01-23 12:09:32', '2019-01-23 12:09:32');  


INSERT INTO `migrations` ( `id`, `migration`, `batch`) VALUES 
('1', '2014_10_12_000000_create_users_table', '1'), 
('2', '2014_10_12_100000_create_password_resets_table', '1'), 
('3', '2019_01_23_052227_create_admins_table', '1');  


 


INSERT INTO `users` ( `id`, `name`, `email`, `password`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES 
('1', 'User Name', 'user@email.com', '$2y$10$e2rhBY5ZlyqdF4EtsoBv.eIkhHZfr7lD.4jJxxX7JAA1ejzdeurO2', 'pending', '', 'yJdb6cxm8zamqzaMBO4Hm2pre11Iw1RvXdoxSOYsaXF0l33cdGuOHtrjBtKw', '2019-01-23 08:14:05', '2019-01-23 08:14:05'); 