ALTER TABLE `vendor` ADD `ref_code` VARCHAR(500) NOT NULL AFTER `stripe_sub`;
ALTER TABLE `membership` ADD `promo_check` INT NOT NULL DEFAULT '0' AFTER `discount`;