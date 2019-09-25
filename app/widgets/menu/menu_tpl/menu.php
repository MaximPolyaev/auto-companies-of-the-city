<?php if(!$category['id_parent']): ?>
<li class="sidebar-menu-item <?= $this->isActive($id) ? 'active' : '' ?>">
    <a class="sidebar-menu-item_link" href="<?= $category['href'] ?>">
        <i class="fa fa-2x <?= $category['fa_icon'] ?> sidebar-menu-item_link_icon" <?= $category['fa_style'] ? "style=\"{$category['fa_style']}\" " : '' ?>></i>
        <span class="sidebar-menu-item_link_title"><?= $category['name'] ?></span>
    </a>
    <?php if(isset($category['childs'])): ?>
        <i class="fa fa-2x fa-angle-left sidebar-menu-item_angle"></i>
        <ul class="sidebar-menu-categories">
        <?php foreach($category['childs'] as $key => $child): ?>
            <li class="sidebar-menu-categories-item <?= $this->isActive($key) ? 'active' : '' ?>">
                <a class="sidebar-menu-categories-item_link" href="<?= $child['href'] ?>">
                    <i class="fa <?= $child['fa_icon'] ?> sidebar-menu-categories-item_link_icon"></i>
                    <span class="sidebar-menu-categories-item_link_title"><?= $child['name'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</li>
<?php endif; ?>