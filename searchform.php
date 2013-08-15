<form action="/" method="get" id="header-search-form">
    <fieldset>
        <input type="text" name="s" id="header-search" value="<?php the_search_query(); ?>" />
        <input type="image" class="submit-search" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search-button.png" />
        <img class="submit-dummy-button" src="<?php bloginfo( 'template_url' ); ?>/images/search-button.png" />
    </fieldset>
</form>