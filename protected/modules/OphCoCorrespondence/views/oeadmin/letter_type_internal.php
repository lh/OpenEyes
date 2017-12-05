<?php
/**
 * Created by PhpStorm.
 * User: Zhaolian
 * Date: 5/12/2017
 * Time: 2:55 PM
 */
?>
<tr class="" data-id="<?php echo $row->id ?>" onclick="<?php Yii::app()->user->setFlash('notice', "Internal Referral Type can not be changed."); ?>" >
  <td>
  </td>
    <?php foreach ($admin->getListFields() as $listItem):
    if ($listItem === 'is_active'):
        ?>
        <td>
            <?php
            $attr_val = $admin->attributeValue($row, $listItem);
            echo $attr_val? 'Yes': 'No';
            ?>
        </td>
        <?php
    elseif ($listItem !== 'attribute_elements_id.id'):
        ?>
        <td>
            <?php
            $attr_val = $admin->attributeValue($row, $listItem);
            if (gettype($attr_val) === 'boolean'):
                if ($admin->attributeValue($row, $listItem)):
                    ?><i class="fa fa-check"></i><?php
                else:
                    ?><i class="fa fa-times"></i><?php
                endif;
            elseif(gettype($attr_val) === 'array'):
                echo implode(',', $admin->attributeValue($row, $listItem));
            elseif ($listItem === 'display_order'):
                ?>
                &uarr;&darr;<input type="hidden" name="<?php echo $admin->getModelName(); ?>[display_order][]" value="<?php echo $row->id ?>">
                <?php
            else:
                echo $attr_val;
            endif
            ?>
        </td>
    <?php endif;
    if ($listItem === 'attribute_elements_id.id'):
        $mappingId = $admin->attributeValue($row, $listItem);
    endif;

    if ($listItem === 'attribute_elements.name'):?>
        <td>
            <?php if (($mappingId > 0)): ?>
                <a onMouseOver="this.style.color='#AFEEEE'" onMouseOut="this.style.color='#00F'"
                   href="../../OphCiExamination/admin/manageElementAttributes?attribute_element_id=<?php echo $mappingId ?>">Manage Options</a>
            <?php endif; ?>
        </td>
        <?php
    endif;
endforeach; ?>
</tr>
