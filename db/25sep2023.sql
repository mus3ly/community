ALTER TABLE `modules` ADD `store_check` INT NOT NULL DEFAULT '0' AFTER `bpage_sort`;
ALTER TABLE `product` ADD `specification` TEXT NULL AFTER `checkbox_h`, ADD `warranty_info` TEXT NULL AFTER `specification`, ADD `shipping_info` TEXT NULL AFTER `warranty_info`, ADD `seller_profile` TEXT NULL AFTER `shipping_info`;
