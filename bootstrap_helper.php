<?php
// app/Helpers/bootstrap_helper.php
use CodeIgniter\CodeIgniter;

function bs_nav_item(string $page_url, string $nav_item_text, array $options = null): string {
    $disabled = $options['disabled'] ?? false;
    $is_current_page = ($page_url == uri_string());
    $href = base_url($page_url);

    // Handle 'nav-link' classes and attributes
    $a_additional_classes = $options['a_classes'] ?? '';
    $a_extra_attributes = $options['a_attributes'] ?? [];
    $a_classes = 'nav-link' . ($is_current_page ? ' active' : '') . ($disabled ? ' disabled' : '') . ' ' . $a_additional_classes;
    $a_attributes = array_merge(['class' => trim($a_classes), 'href' => $href], $a_extra_attributes);

    // Build 'a' tag
    $a_tag = bs_html_builder('a', $nav_item_text, $a_attributes);

    // Handle 'nav-item' classes and attributes
    $li_additional_classes = $options['li_classes'] ?? '';
    $li_extra_attributes = $options['li_attributes'] ?? [];
    $li_classes = 'nav-item ' . $li_additional_classes;
    $li_attributes = array_merge(['class' => trim($li_classes)], $li_extra_attributes);

    // Build 'li' tag
    $li_tag = bs_html_builder('li', $a_tag, $li_attributes);

    return $li_tag;
}

// ==================================================

function bs_nav_dropdown(string $dropdown_url, string $dropdown_text, array $dropdown_items, array $options = null): string {
    $disabled = $options['disabled'] ?? false;
    $is_current_page = ($dropdown_url == uri_string());
    $href = base_url($dropdown_url);
    
    
    //Build 'dropdown-item' items
    $dropdown_menu_items = "";
    foreach($dropdown_items as $dropdown_item){
        if(isset($dropdown_item['type'])){
            if($dropdown_item['type'] == 'item'){
                $dropdown_menu_items .= bs_html_builder('li', bs_html_builder('a', $dropdown_item['text'], ['class' => 'dropdown-item', 'href' => $dropdown_item['href']]));
            }else if($dropdown_item['type'] == 'divider'){
                $dropdown_menu_items .= bs_html_builder('li', bs_html_builder('hr', '', ['class' => 'dropdown-divider']));
            }
        }else{
            $dropdown_menu_items .= $dropdown_item;
        }
    }
    
    // Build 'ul.dropdown-menu' tag
    $dropdown_menu = bs_html_builder('ul', $dropdown_menu_items, ['class' => 'dropdown-menu']);
    
    //Build 'a.nav-link' tag
    $nav_link = bs_html_builder('a', $dropdown_text, ['class' => 'nav-link dropdown-toggle', 'href' => '#', 'role' => 'button', 'data-bs-toggle' => 'dropdown', 'aria-expanded' => 'false']);
    
    //Build 'li.nav-item' tag
    $nav_item = bs_html_builder('li', $nav_link . $dropdown_menu, ['class' => 'nav-item dropdown']);
    
    return $nav_item;
}

// ==================================================

function bs_html_builder(string $tag, string $content = '', array $attributes = [], bool $requires_closing_tag = true): string {
    // Initialize the attribute string
    $attrString = '';

    // Build the attribute string
    foreach ($attributes as $key => $value) {
        if (is_bool($value)) {
            if ($value) {
                $attrString .= " {$key}";
            }
        } else {
            $attrString .= " {$key}=\"" . htmlspecialchars($value, ENT_QUOTES) . "\"";
        }
    }

    // Generate the HTML based on whether a closing tag is required
    if ($requires_closing_tag) {
        return "<{$tag}{$attrString}>{$content}</{$tag}>";
    } else {
        return "<{$tag}{$attrString} />";
    }
}
?>