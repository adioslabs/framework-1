<?php
/**
 * Bluz Framework Component
 *
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/framework
 */

/**
 * @namespace
 */
namespace Bluz\Translator;

use Bluz\Common\Exception\ConfigurationException;
use Bluz\Common\Options;

/**
 * Translator based on gettext library
 *
 * @package  Bluz\Translator
 * @author   Anton Shevchuk
 * @link     https://github.com/bluzphp/framework/wiki/Translator
 */
class Translator
{
    use Options;

    /**
     * Locale
     *
     * @var string
     * @link http://www.loc.gov/standards/iso639-2/php/code_list.php
     */
    protected $locale = 'en_US';

    /**
     * @var string text domain
     */
    protected $domain = 'messages';

    /**
     * @var string path to text domain files
     */
    protected $path;

    /**
     * Set domain
     *
     * @param  string $domain
     * @return self
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Set locale
     *
     * @param  string $locale
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Set path to l10n
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Initialization
     *
     * @return void
     * @throw  \Bluz\Config\ConfigException
     */
    protected function initOptions()
    {
        // Setup locale
        putenv('LC_ALL=' . $this->locale);
        putenv('LANG=' . $this->locale);
        putenv('LANGUAGE=' . $this->locale);

        // Windows workaround
        if (!defined('LC_MESSAGES')) {
            define('LC_MESSAGES', 6);
        }

        setlocale(LC_MESSAGES, $this->locale);

        // For gettext only
        if (function_exists('gettext')) {
            // Setup domain path
            $this->addTextDomain($this->domain, $this->path);

            // Setup default domain
            textdomain($this->domain);
        }
    }

    /**
     * Add text domain for gettext
     *
     * @param  string $domain of text for gettext setup
     * @param  string $path on filesystem
     * @return self
     * @throws ConfigurationException
     */
    public function addTextDomain($domain, $path)
    {
        // check path
        if (!is_dir($path)) {
            throw new ConfigurationException("Translator configuration path `$path` not found");
        }

        bindtextdomain($domain, $path);

        // @todo: hardcoded codeset
        bind_textdomain_codeset($domain, 'UTF-8');

        return $this;
    }

    /**
     * Translate message
     *
     * Simple example of usage
     * equal to gettext('Message')
     *     Translator::translate('Message');
     *
     * Simple replace of one or more argument(s)
     * equal to sprintf(gettext('Message to %s'), 'Username')
     *     Translator::translate('Message to %s', 'Username');
     *
     * @param  string $message
     * @param  string ...$text
     * @return string
     */
    public static function translate($message, ...$text)
    {
        if (empty($message)) {
            return $message;
        }

        if (function_exists('gettext')) {
            $message = gettext($message);
        }

        if (func_num_args() > 1) {
            $message = vsprintf($message, $text);
        }

        return $message;
    }

    /**
     * Translate plural form
     *
     * Example of usage plural form + sprintf
     * equal to sprintf(ngettext('%d comment', '%d comments', 4), 4)
     *     Translator::translatePlural('%d comment', '%d comments', 4, 4)
     *
     * Example of usage plural form + sprintf
     * equal to sprintf(ngettext('%d comment', '%d comments', 4), 4, 'Topic')
     *     Translator::translatePlural('%d comment to %s', '%d comments to %s', 4, 'Topic')
     *
     * @param  string  $singular
     * @param  string  $plural
     * @param  integer $number
     * @param  string  ...$text
     * @return string
     * @link   http://docs.translatehouse.org/projects/localization-guide/en/latest/l10n/pluralforms.html
     */
    public static function translatePlural($singular, $plural, $number, ...$text)
    {
        if (function_exists('ngettext')) {
            $message = ngettext($singular, $plural, $number);
        } else {
            $message = $singular;
        }

        if (func_num_args() > 3) {
            // first element is number
            array_unshift($text, $number);
            $message = vsprintf($message, $text);
        }

        return $message;
    }
}
