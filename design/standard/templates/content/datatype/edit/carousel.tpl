{let foo=$attribute.content}
<table class="list" cellspacing="0">
    <tr>
        <th class="tight">&nbsp;</th>
        <th>Image</th>
        <th>Caption</th>
        <th>Link</th>
    </tr>
    <tr>
        <td></td>
        <td>{$foo}</td>
        <td> <input class="button" type="submit" name="CustomActionButton[{$attribute.id}_browse_images]" value="{'Add existing objects'|i18n( 'design/standard/content/datatype' )}" title="{'Browse to add existing objects in this relation'|i18n( 'design/standard/content/datatype' )}" /></td>
    </tr>


</table>