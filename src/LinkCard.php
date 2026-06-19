<?php

/**
 * Renders an HTML link card with safe escaping.
 * The card includes a title, description, and a clickable link.
 */
class LinkCardRenderer
{
    private string $title;
    private string $description;
    private string $url;
    private string $keyword;
    private array $styles;

    /**
     * @param string $title       Card title
     * @param string $description Card description
     * @param string $url         Target URL
     * @param string $keyword     Highlight keyword
     * @param array  $styles      Optional CSS class names
     */
    public function __construct(
        string $title,
        string $description,
        string $url,
        string $keyword = '',
        array $styles = []
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->keyword = $keyword;
        $this->styles = $styles;
    }

    /**
     * Render the card as a safe HTML string.
     *
     * @return string
     */
    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $classAttr = '';
        if (!empty($this->styles)) {
            $classAttr = ' class="' . htmlspecialchars(implode(' ', $this->styles), ENT_QUOTES, 'UTF-8') . '"';
        }

        $html = <<<HTML
<div{$classAttr} style="border:1px solid #ddd;border-radius:8px;padding:16px;max-width:400px;font-family:sans-serif;background:#f9f9f9;">
    <h3 style="margin:0 0 8px 0;color:#333;">{$escapedTitle}</h3>
    <p style="margin:0 0 12px 0;color:#666;line-height:1.4;">{$escapedDescription}</p>
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" style="display:inline-block;padding:8px 16px;background:#0073e6;color:white;text-decoration:none;border-radius:4px;font-weight:bold;">
        访问 {$escapedKeyword}
    </a>
</div>
HTML;

        return $html;
    }

    /**
     * Create a sample card for demonstration.
     *
     * @return self
     */
    public static function createSample(): self
    {
        return new self(
            '爱游戏 - 发现精彩',
            '探索无限的游戏世界，体验最新最热的互动娱乐。爱游戏带你进入全新的数字冒险。',
            'https://ayxzh.com',
            '爱游戏',
            ['link-card', 'featured']
        );
    }
}

// Example usage (uncomment to test):
// $card = LinkCardRenderer::createSample();
// echo $card->render();