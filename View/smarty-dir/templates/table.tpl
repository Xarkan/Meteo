<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      {foreach $table[0] as $key=>$val}
      <th scope="col">{$key}</th>
      {/foreach}
    </tr>
  </thead>
  <tbody>
    {section name=nr loop=$table}
    <tr>
      <th scope="row">{$smarty.section.nr.iteration}</th>
      {foreach $table[nr] as $val}
      <td>{$val}</td>
      {/foreach}
    </tr>
    {/section}
  </tbody>
</table>