<?php
/**
 * Intact Case: Natural interconversion for camelCase and snake_case with acronym.
 * Copyright (c) 2015 Stew Eucen (http://lab.kochlein.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     StewEucen
 * @category   PHP
 * @copyright  Copyright (c) 2015 Stew Eucen (http://lab.kochlein.com)
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link       http://lab.kochlein.com/IntactCase
 * @package    StewEucen\Acts
 * @subpackage -
 * @since      File available since Release 1.0.0
 * @version    Release 1.0.1
 */
namespace StewEucen\Acts;

class IntactCase
{
  /**
   * Correspondence table for alias of methods.
   *
   * @var array : key = alias, value = action.
   */
  protected static $aliases = [
    'camelCase'   => 'camelize',
    'nerdCaps'    => 'camelize',
    'StudlyCaps'  => 'studlyCaps',
    'pascalCase'  => 'studlyCaps',
    'PascalCase'  => 'studlyCaps',
    'snakeCase'   => 'delimiterize',
    'snake_case'  => 'delimiterize',
    'underscored' => 'delimiterize',
    'trainCase'   => 'hyphenated',
    'chainCase'   => 'hyphenated',
    'kebabCase'   => 'hyphenated',
    'spinalCase'  => 'hyphenated',
    'split'       => 'tokenize',
    'explode'     => 'tokenize',
    'join'        => 'compound',
    'implode'     => 'compound',
  ];

  /**
   * Dispatches alias methods when called undefined methods.
   *
   * @author   StewEucen
   * @deprecated none
   * @param    string $method : Unknown static method name.
   * @param    string $args   : Given arguments for the unknown method.
   * @return   string|false : Either action method name of alias or false.
   * @since    Release 1.0.0
   */
  public static function __callStatic($method, $args)
  {
    if (array_key_exists($method, static::$aliases)) {
      return call_user_func_array(
        [__NAMESPACE__ . '\IntactCase', static::$aliases[$method]],
        $args
      );
    } else {
      return false;
    }
  }

  /**
   * Convert to camelCase from delimiterized compound words.
   *
   * @author StewEucen
   * @param  string $haystack  : Delimiterized compound words.
   * @param  string $delimiter : Delimiter to separate $haystack.
   * @return string : camelCase String.
   * @since  Release 1.0.0
   */
  public static function camelize($haystack, $delimiter = '_')
  {
    $d = preg_quote($delimiter);
    $camel_head    = '^([a-z]{2,}' . $d . ')(?:' . $d . '|$)';
    $capitalize    = '(?<=' . $d . ')([a-z])';
    $rear_acronym  = '(?!^)([a-z]+)' . $d . '(?![a-z])';
    $cut_delimiter = '(?<=^|[a-z]{2})' . $d . '|' . $d . '(?=[a-z]{2,}(?:' . $d . '[a-z]|$))';

    $p = "/{$camel_head}|{$capitalize}|{$rear_acronym}|{$cut_delimiter}/";

    return preg_replace_callback(
      $p,
      function($m) {
        $m += ['', '', '', ''];
        return $m[1] ?: strtoupper($m[2] ?: $m[3]);
      },
      $haystack
    );
  }

  /**
   * Convert to StudlyCaps from delimiterized compound words.
   *
   * @author StewEucen
   * @param  string $haystack  : Delimiterized/camelized compound words.
   * @param  string $delimiter : Delimiter to separate $haystack.
   * @return string : StudlyCaps string
   * @since  Release 1.0.0
   */
  public static function studlyCaps($haystack, $delimiter = '_')
  {
    return static::camelize(
      (strrpos($haystack, $delimiter, 0) === 0 ? '' : $delimiter) . $haystack,
      $delimiter
    );
  }

  /**
   * Convert compound words connected by a delimiter from camelCase/StudlyCaps.
   *
   * @author StewEucen
   * @param  string  $haystack     : Compound words (camelCase/StudlyCaps).
   * @param  string  $delimiter    : Concatenate tokens by of $haystack with this.
   * @param  boolean $asVendorPrefix : Treat $haystack as vendor-prefix (CSS).
   * @return string : Delimiterized string.
   * @since  Release 1.0.0
   */
  public static function delimiterize(
    $haystack,
    $delimiter      = '_',
    $asVendorPrefix = false
  ) {
    $d = preg_quote($delimiter);

    $headDelimiter = $asVendorPrefix ? '^(?=[A-Z])|' : '';
    $beforeAcronym = '(?:^[a-z]{2,}' . $d . '|[a-z])(?=[A-Z](?![a-z]))';
    $afterAcronym  = '[A-Z]{2,}(?![a-z])';
    $beforeCapital = '(?!^)(?=[A-Z][a-z])';

    $p = "/{$headDelimiter}{$beforeAcronym}|{$afterAcronym}|{$beforeCapital}/";
    return strtolower(preg_replace($p, '$0' . $delimiter, $haystack));
  }

  /**
   * Hyphenate compound words from camelCase/StudlyCaps.
   *
   * @author StewEucen
   * @param  string  $haystack     : Compound words (camelCase/StudlyCaps).
   * @param  boolean $asVendorPrefix : Treat $haystack as vendor-prefix (CSS).
   * @return string : Hyphenated string.
   * @since  Release 1.0.0
   */
  public static function hyphenated($haystack, $asVendorPrefix = false) {
    return static::delimiterize($haystack, '-', $asVendorPrefix);
  }

  /**
   * Explode to tokens from compound words.
   *
   * @author StewEucen
   * @param  string  $haystack  : Compound words (camelCase/StudlyCaps/delimiterized).
   * @param  string  $delimiter : Delimiter.
   * @param  boolean $rawFirst  : Keep raw first word in tokens for camelCase.
   * @return array : Tokens except delimiter between acronym.
   * @since  Release 1.0.0
   */
  public static function tokenize($haystack, $delimiter = '_', $rawFirst = false) {
    $isCamel = preg_match('/[A-Z]/', $haystack);
    if ($isCamel) {
      return static::_tokenizeFromCamelized($haystack, $delimiter, $rawFirst);
    } else {
      return static::_tokenizeFromDelimiterized($haystack, $delimiter);
    }
  }

  /**
   * Tokenize from camelCase/StudlyCaps.
   *
   * @author StewEucen
   * @param  string  $haystack  : Compound words (camelCase/StudlyCaps).
   * @param  string  $delimiter : Delimiter between acronym.
   * @param  boolean $rawFirst  : Keep raw first word in tokens for camelCase.
   * @return array : Tokens except delimiter between acronym.
   * @since  Release 1.0.0
   */
  protected static function _tokenizeFromCamelized($haystack, $delimiter, $rawFirst) {
    $d = preg_quote($delimiter);
    $p = '/(?:[A-Z]+|[A-Z]?(?:[a-z]{2,}' . $d . '?|[a-z]))(?![a-z])/';
    preg_match_all($p, $haystack , $tokens);
    $tokens = $tokens[0];

    // Upcase for acronym of first word in camelCase.
    if (!$rawFirst) {
      $first = reset($tokens);
      if (!preg_match('/[A-Z]/', $first)) {
        $tokens[0] = static::studlyCaps($first, $delimiter);
      }
    }

    return $tokens;
  }

  /**
   * Tokenize from delimiterized string.
   *
   * @author StewEucen
   * @param  string $haystack  : Compound words (delimiterized).
   * @param  string $delimiter : Delimiter.
   * @return array : Tokens except delimiter between acronym.
   * @since  Release 1.0.0
   */
  protected static function _tokenizeFromDelimiterized($haystack, $delimiter) {
    $d = preg_quote($delimiter);
    $p = '/[a-z]+' . $d . '?(?=' . $d . '|$)/';
    preg_match_all($p, $haystack , $tokens);
    return $tokens[0];
  }

  /**
   * Concatenate tokens (camelCase/StudlyCaps/delimiterized).
   *
   * @author StewEucen
   * @param  array  $tokens    : Tokens.
   * @param  string $delimiter : Delimiter between acronym.
   * @return string : camelCase/StudlyCaps/delimiterized.
   * @since  Release 1.0.0
   */
  public static function compound($tokens, $delimiter = '_')
  {
    $compounded = join($delimiter, $tokens);
    $isCamel = preg_match('/[A-Z]/', $compounded);

    $d = preg_quote($delimiter);
    if ($isCamel) {
      $p = '/(?<=.[a-z])' . $d . '|(?<!' . $d . ')' . $d . '(?=[A-Z][a-z])/';
      return preg_replace($p, '', $compounded);
    }

    return $compounded;
  }

  /**
   * First word to capitalize, even if it was acronym.
   *
   * @author StewEucen
   * @param  string $haystack  : Conpound words (camelCase/StudlyCaps).
   * @param  string $delimiter : Delimiter after acronym.
   * @return string : StudlyCaps (= capitalized camelCase).
   * @since  Release 1.0.0
   */
  public static function ucFirst($haystack, $delimiter = '_')
  {
    return static::studlyCaps(
      static::delimiterize($haystack, $delimiter),
      $delimiter
    );
  }

  /**
   * First word to uncapitalize, even if it was acronym.
   *
   * @author StewEucen
   * @param  string $haystack  : Conpound words (camelCase/StudlyCaps).
   * @param  string $delimiter : Delimiter after acronym.
   * @return string : camelCase (= uncapitalized StudlyCaps).
   * @since  Release 1.0.0
   */
  public static function lcFirst($haystack, $delimiter = '_')
  {
    return static::camelCase(
      static::delimiterize($haystack, $delimiter),
      $delimiter
    );
  }
}
