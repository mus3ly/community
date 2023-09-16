ALTER TABLE `member_cat` ADD `visible` INT NOT NULL DEFAULT '0' AFTER `status`, ADD `promo_cat` INT NOT NULL DEFAULT '0' AFTER `visible`;
ALTER TABLE `user` ADD `referral_code` VARCHAR(500) NOT NULL AFTER `TOC`;
