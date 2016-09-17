<div class="page-header">
    <h2><?= t('Custom Project Roles') ?></h2>
    <ul>
        <li>
            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
            <?= $this->url->link(t('Add a new custom role'), 'ProjectRoleController', 'create', array('project_id' => $project['id']), false, 'popover') ?>
        </li>
    </ul>
</div>

<?php if (empty($roles)): ?>
    <div class="alert"><?= t('There is no custom role for this project.') ?></div>
<?php else: ?>
    <?php foreach ($roles as $role): ?>
    <table class="table-striped">
        <tr>
            <th>
                <div class="dropdown">
                    <a href="#" class="dropdown-menu"><?= t('Restrictions for the role "%s"', $role['role']) ?> <i class="fa fa-caret-down"></i></a>
                    <ul>
                        <li>
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                            <?= $this->url->link(t('Add a new project restriction'), 'ProjectRoleRestrictionController', 'create', array('project_id' => $project['id'], 'role_id' => $role['role_id']), false, 'popover') ?>
                        </li>
                        <li>
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                            <?= $this->url->link(t('Add a new column restriction'), 'ColumnMoveRestrictionController', 'create', array('project_id' => $project['id'], 'role_id' => $role['role_id']), false, 'popover') ?>
                        </li>
                        <li>
                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                            <?= $this->url->link(t('Edit this role'), 'ProjectRoleController', 'edit', array('project_id' => $project['id'], 'role_id' => $role['role_id']), false, 'popover') ?>
                        </li>
                        <li>
                            <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
                            <?= $this->url->link(t('Remove this role'), 'ProjectRoleController', 'confirm', array('project_id' => $project['id'], 'role_id' => $role['role_id']), false, 'popover') ?>
                        </li>
                    </ul>
                </div>
            </th>
            <th class="column-15">
                <?= t('Actions') ?>
            </th>
        </tr>
        <?php if (empty($role['project_restrictions']) && empty($role['column_restrictions'])): ?>
            <tr>
                <td colspan="2"><?= t('There is no restriction for this role.') ?></td>
            </tr>
        <?php else: ?>
            <?php foreach ($role['project_restrictions'] as $restriction): ?>
                <tr>
                    <td>
                        <?= $this->text->e($restriction['title']) ?>
                    </td>
                    <td>
                        <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
                        <?= $this->url->link(t('Remove'), 'ProjectRoleRestrictionController', 'confirm', array('project_id' => $project['id'], 'restriction_id' => $restriction['restriction_id']), false, 'popover') ?>
                    </td>
                </tr>
            <?php endforeach ?>
            <?php foreach ($role['column_restrictions'] as $restriction): ?>
                <tr>
                    <td>
                        <?= t('Only moving task from the column "%s" to "%s" is permitted', $restriction['src_column_title'], $restriction['dst_column_title']) ?>
                    </td>
                    <td>
                        <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
                        <?= $this->url->link(t('Remove'), 'ColumnMoveRestrictionController', 'confirm', array('project_id' => $project['id'], 'restriction_id' => $restriction['restriction_id']), false, 'popover') ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>
    <?php endforeach ?>
<?php endif ?>
