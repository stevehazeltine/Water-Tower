<form action="/" method="get">
    <fieldset>
        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
        <input type="image" class="submit-search" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search-01.png" />
    </fieldset>
</form>