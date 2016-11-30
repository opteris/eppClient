SELECT i.tbl_menu_itemsId, i.MenuCategory, i.MenuItem, p.MenuItem as pMenuItem, i.LinkvalCode, i.Rank 
FROM `tbl_menu_items`  i
left join `tbl_permisions` p on (p.MenuItem = i.tbl_menu_itemsId 
group by i.tbl_menu_itemsId, i.MenuCategory, i.MenuItem, p.MenuItem , i.LinkvalCode, i.Rank 
order by i.`Rank`,i.`MenuItem`


update tbl_permisions p join tbl_staff_groups g on (g.groupCode = p.groupCode) set p.groupCode=g.tbl_staff_groupsId

UPDATE `tbl_menu_items` SET `MenuItem` = 'System Permissions', `ControllerName` = 'SystemSetup', `ViewFile` = 'staffPermissions', `LinkvalCode` = 'staffPermissions' WHERE `tbl_menu_items`.`tbl_menu_itemsId` = 59;