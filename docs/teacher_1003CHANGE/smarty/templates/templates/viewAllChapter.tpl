{* Smarty *}
{include file="teacherHead.tpl"}
Chpater List

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<ul>
<li>
	<th>章节号</th>
	<th>章节名</th>
</li>

{foreach $chapterlist as $item}
        <li>
        {foreach $item as $key=>$value}
                <th>{$value}</th>
        {/foreach}
        </li>
{/foreach}
</ul>
