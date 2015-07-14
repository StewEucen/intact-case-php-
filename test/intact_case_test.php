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
 * @version    Release 1.0.0
 */
use StewEucen\Acts\IntactCase;

// c  = camelCase
// s  = StudlyCaps
// d  = delimiterized
// ts = tokens of camelCase
// td = tokens of camelCase
$testValues = [
  ['c' => 'a',    's' => 'A',   'd' => 'a',    'ts' => ['A'],   'td' => ['a']],
  ['c' => 'bb',   's' => 'Bb',  'd' => 'bb',   'ts' => ['Bb'],  'td' => ['bb']],
  ['c' => 'cc_',  's' => 'CC',  'd' => 'cc_',  'ts' => ['CC'],  'td' => ['cc_']],
  ['c' => 'ddd',  's' => 'Ddd', 'd' => 'ddd',  'ts' => ['Ddd'], 'td' => ['ddd']],
  ['c' => 'eee_', 's' => 'EEE', 'd' => 'eee_', 'ts' => ['EEE'], 'td' => ['eee_']],


  ['c' => 'a_A',   's' => 'A_A',   'd' => 'a_a',    'ts' => ['A', 'A'],   'td' => ['a', 'a']],
  ['c' => 'aBb',   's' => 'ABb',   'd' => 'a_bb',   'ts' => ['A', 'Bb'],  'td' => ['a', 'bb']],
  ['c' => 'a_CC',  's' => 'A_CC',  'd' => 'a_cc_',  'ts' => ['A', 'CC'],  'td' => ['a', 'cc_']],
  ['c' => 'aDdd',  's' => 'ADdd',  'd' => 'a_ddd',  'ts' => ['A', 'Ddd'], 'td' => ['a', 'ddd']],
  ['c' => 'a_EEE', 's' => 'A_EEE', 'd' => 'a_eee_', 'ts' => ['A', 'EEE'], 'td' => ['a', 'eee_']],

  ['c' => 'bbA',   's' => 'BbA',   'd' => 'bb_a',    'ts' => ['Bb', 'A'],   'td' => ['bb', 'a']],
  ['c' => 'bbBb',  's' => 'BbBb',  'd' => 'bb_bb',   'ts' => ['Bb', 'Bb'],  'td' => ['bb', 'bb']],
  ['c' => 'bbCC',  's' => 'BbCC',  'd' => 'bb_cc_',  'ts' => ['Bb', 'CC'],  'td' => ['bb', 'cc_']],
  ['c' => 'bbDdd', 's' => 'BbDdd', 'd' => 'bb_ddd',  'ts' => ['Bb', 'Ddd'], 'td' => ['bb', 'ddd']],
  ['c' => 'bbEEE', 's' => 'BbEEE', 'd' => 'bb_eee_', 'ts' => ['Bb', 'EEE'], 'td' => ['bb', 'eee_']],

  ['c' => 'cc_A',   's' => 'CC_A',   'd' => 'cc__a',    'ts' => ['CC', 'A'],   'td' => ['cc_', 'a']],
  ['c' => 'cc_Bb',  's' => 'CCBb',   'd' => 'cc__bb',   'ts' => ['CC', 'Bb'],  'td' => ['cc_', 'bb']],
  ['c' => 'cc_CC',  's' => 'CC_CC',  'd' => 'cc__cc_',  'ts' => ['CC', 'CC'],  'td' => ['cc_', 'cc_']],
  ['c' => 'cc_Ddd', 's' => 'CCDdd',  'd' => 'cc__ddd',  'ts' => ['CC', 'Ddd'], 'td' => ['cc_', 'ddd']],
  ['c' => 'cc_EEE', 's' => 'CC_EEE', 'd' => 'cc__eee_', 'ts' => ['CC', 'EEE'], 'td' => ['cc_', 'eee_']],

  ['c' => 'dddA',   's' => 'DddA',   'd' => 'ddd_a',    'ts' => ['Ddd', 'A'],   'td' => ['ddd', 'a']],
  ['c' => 'dddBb',  's' => 'DddBb',  'd' => 'ddd_bb',   'ts' => ['Ddd', 'Bb'],  'td' => ['ddd', 'bb']],
  ['c' => 'dddCC',  's' => 'DddCC',  'd' => 'ddd_cc_',  'ts' => ['Ddd', 'CC'],  'td' => ['ddd', 'cc_']],
  ['c' => 'dddDdd', 's' => 'DddDdd', 'd' => 'ddd_ddd',  'ts' => ['Ddd', 'Ddd'], 'td' => ['ddd', 'ddd']],
  ['c' => 'dddEEE', 's' => 'DddEEE', 'd' => 'ddd_eee_', 'ts' => ['Ddd', 'EEE'], 'td' => ['ddd', 'eee_']],

  ['c' => 'eee_A',   's' => 'EEE_A',   'd' => 'eee__a',    'ts' => ['EEE', 'A'],   'td' => ['eee_', 'a']],
  ['c' => 'eee_Bb',  's' => 'EEEBb',   'd' => 'eee__bb',   'ts' => ['EEE', 'Bb'],  'td' => ['eee_', 'bb']],
  ['c' => 'eee_CC',  's' => 'EEE_CC',  'd' => 'eee__cc_',  'ts' => ['EEE', 'CC'],  'td' => ['eee_', 'cc_']],
  ['c' => 'eee_Ddd', 's' => 'EEEDdd',  'd' => 'eee__ddd',  'ts' => ['EEE', 'Ddd'], 'td' => ['eee_', 'ddd']],
  ['c' => 'eee_EEE', 's' => 'EEE_EEE', 'd' => 'eee__eee_', 'ts' => ['EEE', 'EEE'], 'td' => ['eee_', 'eee_']],


  ['c' => 'a_A_A',   's' => 'A_A_A',   'd' => 'a_a_a',    'ts' => ['A', 'A', 'A'],   'td' => ['a', 'a', 'a']],
  ['c' => 'a_ABb',   's' => 'A_ABb',   'd' => 'a_a_bb',   'ts' => ['A', 'A', 'Bb'],  'td' => ['a', 'a', 'bb']],
  ['c' => 'a_A_CC',  's' => 'A_A_CC',  'd' => 'a_a_cc_',  'ts' => ['A', 'A', 'CC'],  'td' => ['a', 'a', 'cc_']],
  ['c' => 'a_ADdd',  's' => 'A_ADdd',  'd' => 'a_a_ddd',  'ts' => ['A', 'A', 'Ddd'], 'td' => ['a', 'a', 'ddd']],
  ['c' => 'a_A_EEE', 's' => 'A_A_EEE', 'd' => 'a_a_eee_', 'ts' => ['A', 'A', 'EEE'], 'td' => ['a', 'a', 'eee_']],

  ['c' => 'aBbA',   's' => 'ABbA',   'd' => 'a_bb_a',    'ts' => ['A', 'Bb', 'A'],   'td' => ['a', 'bb', 'a']],
  ['c' => 'aBbBb',  's' => 'ABbBb',  'd' => 'a_bb_bb',   'ts' => ['A', 'Bb', 'Bb'],  'td' => ['a', 'bb', 'bb']],
  ['c' => 'aBbCC',  's' => 'ABbCC',  'd' => 'a_bb_cc_',  'ts' => ['A', 'Bb', 'CC'],  'td' => ['a', 'bb', 'cc_']],
  ['c' => 'aBbDdd', 's' => 'ABbDdd', 'd' => 'a_bb_ddd',  'ts' => ['A', 'Bb', 'Ddd'], 'td' => ['a', 'bb', 'ddd']],
  ['c' => 'aBbEEE', 's' => 'ABbEEE', 'd' => 'a_bb_eee_', 'ts' => ['A', 'Bb', 'EEE'], 'td' => ['a', 'bb', 'eee_']],

  ['c' => 'a_CC_A',   's' => 'A_CC_A',   'd' => 'a_cc__a',    'ts' => ['A', 'CC', 'A'],   'td' => ['a', 'cc_', 'a']],
  ['c' => 'a_CCBb',   's' => 'A_CCBb',   'd' => 'a_cc__bb',   'ts' => ['A', 'CC', 'Bb'],  'td' => ['a', 'cc_', 'bb']],
  ['c' => 'a_CC_CC',  's' => 'A_CC_CC',  'd' => 'a_cc__cc_',  'ts' => ['A', 'CC', 'CC'],  'td' => ['a', 'cc_', 'cc_']],
  ['c' => 'a_CCDdd',  's' => 'A_CCDdd',  'd' => 'a_cc__ddd',  'ts' => ['A', 'CC', 'Ddd'], 'td' => ['a', 'cc_', 'ddd']],
  ['c' => 'a_CC_EEE', 's' => 'A_CC_EEE', 'd' => 'a_cc__eee_', 'ts' => ['A', 'CC', 'EEE'], 'td' => ['a', 'cc_', 'eee_']],

  ['c' => 'aDddA',   's' => 'ADddA',   'd' => 'a_ddd_a',    'ts' => ['A', 'Ddd', 'A'],   'td' => ['a', 'ddd', 'a']],
  ['c' => 'aDddBb',  's' => 'ADddBb',  'd' => 'a_ddd_bb',   'ts' => ['A', 'Ddd', 'Bb'],  'td' => ['a', 'ddd', 'bb']],
  ['c' => 'aDddCC',  's' => 'ADddCC',  'd' => 'a_ddd_cc_',  'ts' => ['A', 'Ddd', 'CC'],  'td' => ['a', 'ddd', 'cc_']],
  ['c' => 'aDddDdd', 's' => 'ADddDdd', 'd' => 'a_ddd_ddd',  'ts' => ['A', 'Ddd', 'Ddd'], 'td' => ['a', 'ddd', 'ddd']],
  ['c' => 'aDddEEE', 's' => 'ADddEEE', 'd' => 'a_ddd_eee_', 'ts' => ['A', 'Ddd', 'EEE'], 'td' => ['a', 'ddd', 'eee_']],

  ['c' => 'a_EEE_A',   's' => 'A_EEE_A',   'd' => 'a_eee__a',    'ts' => ['A', 'EEE', 'A'],   'td' => ['a', 'eee_', 'a']],
  ['c' => 'a_EEEBb',   's' => 'A_EEEBb',   'd' => 'a_eee__bb',   'ts' => ['A', 'EEE', 'Bb'],  'td' => ['a', 'eee_', 'bb']],
  ['c' => 'a_EEE_CC',  's' => 'A_EEE_CC',  'd' => 'a_eee__cc_',  'ts' => ['A', 'EEE', 'CC'],  'td' => ['a', 'eee_', 'cc_']],
  ['c' => 'a_EEEDdd',  's' => 'A_EEEDdd',  'd' => 'a_eee__ddd',  'ts' => ['A', 'EEE', 'Ddd'], 'td' => ['a', 'eee_', 'ddd']],
  ['c' => 'a_EEE_EEE', 's' => 'A_EEE_EEE', 'd' => 'a_eee__eee_', 'ts' => ['A', 'EEE', 'EEE'], 'td' => ['a', 'eee_', 'eee_']],


  ['c' => 'bbA_A',   's' => 'BbA_A',   'd' => 'bb_a_a',    'ts' => ['Bb', 'A', 'A'],   'td' => ['bb', 'a', 'a']],
  ['c' => 'bbABb',   's' => 'BbABb',   'd' => 'bb_a_bb',   'ts' => ['Bb', 'A', 'Bb'],  'td' => ['bb', 'a', 'bb']],
  ['c' => 'bbA_CC',  's' => 'BbA_CC',  'd' => 'bb_a_cc_',  'ts' => ['Bb', 'A', 'CC'],  'td' => ['bb', 'a', 'cc_']],
  ['c' => 'bbADdd',  's' => 'BbADdd',  'd' => 'bb_a_ddd',  'ts' => ['Bb', 'A', 'Ddd'], 'td' => ['bb', 'a', 'ddd']],
  ['c' => 'bbA_EEE', 's' => 'BbA_EEE', 'd' => 'bb_a_eee_', 'ts' => ['Bb', 'A', 'EEE'], 'td' => ['bb', 'a', 'eee_']],

  ['c' => 'bbBbA',   's' => 'BbBbA',   'd' => 'bb_bb_a',    'ts' => ['Bb', 'Bb', 'A'],   'td' => ['bb', 'bb', 'a']],
  ['c' => 'bbBbBb',  's' => 'BbBbBb',  'd' => 'bb_bb_bb',   'ts' => ['Bb', 'Bb', 'Bb'],  'td' => ['bb', 'bb', 'bb']],
  ['c' => 'bbBbCC',  's' => 'BbBbCC',  'd' => 'bb_bb_cc_',  'ts' => ['Bb', 'Bb', 'CC'],  'td' => ['bb', 'bb', 'cc_']],
  ['c' => 'bbBbDdd', 's' => 'BbBbDdd', 'd' => 'bb_bb_ddd',  'ts' => ['Bb', 'Bb', 'Ddd'], 'td' => ['bb', 'bb', 'ddd']],
  ['c' => 'bbBbEEE', 's' => 'BbBbEEE', 'd' => 'bb_bb_eee_', 'ts' => ['Bb', 'Bb', 'EEE'], 'td' => ['bb', 'bb', 'eee_']],

  ['c' => 'bbCC_A',   's' => 'BbCC_A',   'd' => 'bb_cc__a',    'ts' => ['Bb', 'CC', 'A'],   'td' => ['bb', 'cc_', 'a']],
  ['c' => 'bbCCBb',   's' => 'BbCCBb',   'd' => 'bb_cc__bb',   'ts' => ['Bb', 'CC', 'Bb'],  'td' => ['bb', 'cc_', 'bb']],
  ['c' => 'bbCC_CC',  's' => 'BbCC_CC',  'd' => 'bb_cc__cc_',  'ts' => ['Bb', 'CC', 'CC'],  'td' => ['bb', 'cc_', 'cc_']],
  ['c' => 'bbCCDdd',  's' => 'BbCCDdd',  'd' => 'bb_cc__ddd',  'ts' => ['Bb', 'CC', 'Ddd'], 'td' => ['bb', 'cc_', 'ddd']],
  ['c' => 'bbCC_EEE', 's' => 'BbCC_EEE', 'd' => 'bb_cc__eee_', 'ts' => ['Bb', 'CC', 'EEE'], 'td' => ['bb', 'cc_', 'eee_']],

  ['c' => 'bbDddA',   's' => 'BbDddA',   'd' => 'bb_ddd_a',    'ts' => ['Bb', 'Ddd', 'A'],   'td' => ['bb', 'ddd', 'a']],
  ['c' => 'bbDddBb',  's' => 'BbDddBb',  'd' => 'bb_ddd_bb',   'ts' => ['Bb', 'Ddd', 'Bb'],  'td' => ['bb', 'ddd', 'bb']],
  ['c' => 'bbDddCC',  's' => 'BbDddCC',  'd' => 'bb_ddd_cc_',  'ts' => ['Bb', 'Ddd', 'CC'],  'td' => ['bb', 'ddd', 'cc_']],
  ['c' => 'bbDddDdd', 's' => 'BbDddDdd', 'd' => 'bb_ddd_ddd',  'ts' => ['Bb', 'Ddd', 'Ddd'], 'td' => ['bb', 'ddd', 'ddd']],
  ['c' => 'bbDddEEE', 's' => 'BbDddEEE', 'd' => 'bb_ddd_eee_', 'ts' => ['Bb', 'Ddd', 'EEE'], 'td' => ['bb', 'ddd', 'eee_']],

  ['c' => 'bbEEE_A',   's' => 'BbEEE_A',   'd' => 'bb_eee__a',    'ts' => ['Bb', 'EEE', 'A'],   'td' => ['bb', 'eee_', 'a']],
  ['c' => 'bbEEEBb',   's' => 'BbEEEBb',   'd' => 'bb_eee__bb',   'ts' => ['Bb', 'EEE', 'Bb'],  'td' => ['bb', 'eee_', 'bb']],
  ['c' => 'bbEEE_CC',  's' => 'BbEEE_CC',  'd' => 'bb_eee__cc_',  'ts' => ['Bb', 'EEE', 'CC'],  'td' => ['bb', 'eee_', 'cc_']],
  ['c' => 'bbEEEDdd',  's' => 'BbEEEDdd',  'd' => 'bb_eee__ddd',  'ts' => ['Bb', 'EEE', 'Ddd'], 'td' => ['bb', 'eee_', 'ddd']],
  ['c' => 'bbEEE_EEE', 's' => 'BbEEE_EEE', 'd' => 'bb_eee__eee_', 'ts' => ['Bb', 'EEE', 'EEE'], 'td' => ['bb', 'eee_', 'eee_']],


  ['c' => 'cc_A_A',   's' => 'CC_A_A',   'd' => 'cc__a_a',    'ts' => ['CC', 'A', 'A'],   'td' => ['cc_', 'a', 'a']],
  ['c' => 'cc_ABb',   's' => 'CC_ABb',   'd' => 'cc__a_bb',   'ts' => ['CC', 'A', 'Bb'],  'td' => ['cc_', 'a', 'bb']],
  ['c' => 'cc_A_CC',  's' => 'CC_A_CC',  'd' => 'cc__a_cc_',  'ts' => ['CC', 'A', 'CC'],  'td' => ['cc_', 'a', 'cc_']],
  ['c' => 'cc_ADdd',  's' => 'CC_ADdd',  'd' => 'cc__a_ddd',  'ts' => ['CC', 'A', 'Ddd'], 'td' => ['cc_', 'a', 'ddd']],
  ['c' => 'cc_A_EEE', 's' => 'CC_A_EEE', 'd' => 'cc__a_eee_', 'ts' => ['CC', 'A', 'EEE'], 'td' => ['cc_', 'a', 'eee_']],

  ['c' => 'cc_BbA',   's' => 'CCBbA',   'd' => 'cc__bb_a',    'ts' => ['CC', 'Bb', 'A'],   'td' => ['cc_', 'bb', 'a']],
  ['c' => 'cc_BbBb',  's' => 'CCBbBb',  'd' => 'cc__bb_bb',   'ts' => ['CC', 'Bb', 'Bb'],  'td' => ['cc_', 'bb', 'bb']],
  ['c' => 'cc_BbCC',  's' => 'CCBbCC',  'd' => 'cc__bb_cc_',  'ts' => ['CC', 'Bb', 'CC'],  'td' => ['cc_', 'bb', 'cc_']],
  ['c' => 'cc_BbDdd', 's' => 'CCBbDdd', 'd' => 'cc__bb_ddd',  'ts' => ['CC', 'Bb', 'Ddd'], 'td' => ['cc_', 'bb', 'ddd']],
  ['c' => 'cc_BbEEE', 's' => 'CCBbEEE', 'd' => 'cc__bb_eee_', 'ts' => ['CC', 'Bb', 'EEE'], 'td' => ['cc_', 'bb', 'eee_']],

  ['c' => 'cc_CC_A',   's' => 'CC_CC_A',   'd' => 'cc__cc__a',    'ts' => ['CC', 'CC', 'A'],   'td' => ['cc_', 'cc_', 'a']],
  ['c' => 'cc_CCBb',   's' => 'CC_CCBb',   'd' => 'cc__cc__bb',   'ts' => ['CC', 'CC', 'Bb'],  'td' => ['cc_', 'cc_', 'bb']],
  ['c' => 'cc_CC_CC',  's' => 'CC_CC_CC',  'd' => 'cc__cc__cc_',  'ts' => ['CC', 'CC', 'CC'],  'td' => ['cc_', 'cc_', 'cc_']],
  ['c' => 'cc_CCDdd',  's' => 'CC_CCDdd',  'd' => 'cc__cc__ddd',  'ts' => ['CC', 'CC', 'Ddd'], 'td' => ['cc_', 'cc_', 'ddd']],
  ['c' => 'cc_CC_EEE', 's' => 'CC_CC_EEE', 'd' => 'cc__cc__eee_', 'ts' => ['CC', 'CC', 'EEE'], 'td' => ['cc_', 'cc_', 'eee_']],

  ['c' => 'cc_DddA',   's' => 'CCDddA',   'd' => 'cc__ddd_a',    'ts' => ['CC', 'Ddd', 'A'],   'td' => ['cc_', 'ddd', 'a']],
  ['c' => 'cc_DddBb',  's' => 'CCDddBb',  'd' => 'cc__ddd_bb',   'ts' => ['CC', 'Ddd', 'Bb'],  'td' => ['cc_', 'ddd', 'bb']],
  ['c' => 'cc_DddCC',  's' => 'CCDddCC',  'd' => 'cc__ddd_cc_',  'ts' => ['CC', 'Ddd', 'CC'],  'td' => ['cc_', 'ddd', 'cc_']],
  ['c' => 'cc_DddDdd', 's' => 'CCDddDdd', 'd' => 'cc__ddd_ddd',  'ts' => ['CC', 'Ddd', 'Ddd'], 'td' => ['cc_', 'ddd', 'ddd']],
  ['c' => 'cc_DddEEE', 's' => 'CCDddEEE', 'd' => 'cc__ddd_eee_', 'ts' => ['CC', 'Ddd', 'EEE'], 'td' => ['cc_', 'ddd', 'eee_']],

  ['c' => 'cc_EEE_A',   's' => 'CC_EEE_A',   'd' => 'cc__eee__a',    'ts' => ['CC', 'EEE', 'A'],   'td' => ['cc_', 'eee_', 'a']],
  ['c' => 'cc_EEEBb',   's' => 'CC_EEEBb',   'd' => 'cc__eee__bb',   'ts' => ['CC', 'EEE', 'Bb'],  'td' => ['cc_', 'eee_', 'bb']],
  ['c' => 'cc_EEE_CC',  's' => 'CC_EEE_CC',  'd' => 'cc__eee__cc_',  'ts' => ['CC', 'EEE', 'CC'],  'td' => ['cc_', 'eee_', 'cc_']],
  ['c' => 'cc_EEEDdd',  's' => 'CC_EEEDdd',  'd' => 'cc__eee__ddd',  'ts' => ['CC', 'EEE', 'Ddd'], 'td' => ['cc_', 'eee_', 'ddd']],
  ['c' => 'cc_EEE_EEE', 's' => 'CC_EEE_EEE', 'd' => 'cc__eee__eee_', 'ts' => ['CC', 'EEE', 'EEE'], 'td' => ['cc_', 'eee_', 'eee_']],


  ['c' => 'dddA_A',   's' => 'DddA_A',   'd' => 'ddd_a_a',    'ts' => ['Ddd', 'A', 'A'],   'td' => ['ddd', 'a', 'a']],
  ['c' => 'dddABb',   's' => 'DddABb',   'd' => 'ddd_a_bb',   'ts' => ['Ddd', 'A', 'Bb'],  'td' => ['ddd', 'a', 'bb']],
  ['c' => 'dddA_CC',  's' => 'DddA_CC',  'd' => 'ddd_a_cc_',  'ts' => ['Ddd', 'A', 'CC'],  'td' => ['ddd', 'a', 'cc_']],
  ['c' => 'dddADdd',  's' => 'DddADdd',  'd' => 'ddd_a_ddd',  'ts' => ['Ddd', 'A', 'Ddd'], 'td' => ['ddd', 'a', 'ddd']],
  ['c' => 'dddA_EEE', 's' => 'DddA_EEE', 'd' => 'ddd_a_eee_', 'ts' => ['Ddd', 'A', 'EEE'], 'td' => ['ddd', 'a', 'eee_']],

  ['c' => 'dddBbA',   's' => 'DddBbA',   'd' => 'ddd_bb_a',    'ts' => ['Ddd', 'Bb', 'A'],   'td' => ['ddd', 'bb', 'a']],
  ['c' => 'dddBbBb',  's' => 'DddBbBb',  'd' => 'ddd_bb_bb',   'ts' => ['Ddd', 'Bb', 'Bb'],  'td' => ['ddd', 'bb', 'bb']],
  ['c' => 'dddBbCC',  's' => 'DddBbCC',  'd' => 'ddd_bb_cc_',  'ts' => ['Ddd', 'Bb', 'CC'],  'td' => ['ddd', 'bb', 'cc_']],
  ['c' => 'dddBbDdd', 's' => 'DddBbDdd', 'd' => 'ddd_bb_ddd',  'ts' => ['Ddd', 'Bb', 'Ddd'], 'td' => ['ddd', 'bb', 'ddd']],
  ['c' => 'dddBbEEE', 's' => 'DddBbEEE', 'd' => 'ddd_bb_eee_', 'ts' => ['Ddd', 'Bb', 'EEE'], 'td' => ['ddd', 'bb', 'eee_']],

  ['c' => 'dddCC_A',   's' => 'DddCC_A',   'd' => 'ddd_cc__a',    'ts' => ['Ddd', 'CC', 'A'],   'td' => ['ddd', 'cc_', 'a']],
  ['c' => 'dddCCBb',   's' => 'DddCCBb',   'd' => 'ddd_cc__bb',   'ts' => ['Ddd', 'CC', 'Bb'],  'td' => ['ddd', 'cc_', 'bb']],
  ['c' => 'dddCC_CC',  's' => 'DddCC_CC',  'd' => 'ddd_cc__cc_',  'ts' => ['Ddd', 'CC', 'CC'],  'td' => ['ddd', 'cc_', 'cc_']],
  ['c' => 'dddCCDdd',  's' => 'DddCCDdd',  'd' => 'ddd_cc__ddd',  'ts' => ['Ddd', 'CC', 'Ddd'], 'td' => ['ddd', 'cc_', 'ddd']],
  ['c' => 'dddCC_EEE', 's' => 'DddCC_EEE', 'd' => 'ddd_cc__eee_', 'ts' => ['Ddd', 'CC', 'EEE'], 'td' => ['ddd', 'cc_', 'eee_']],

  ['c' => 'dddDddA',   's' => 'DddDddA',   'd' => 'ddd_ddd_a',    'ts' => ['Ddd', 'Ddd', 'A'],   'td' => ['ddd', 'ddd', 'a']],
  ['c' => 'dddDddBb',  's' => 'DddDddBb',  'd' => 'ddd_ddd_bb',   'ts' => ['Ddd', 'Ddd', 'Bb'],  'td' => ['ddd', 'ddd', 'bb']],
  ['c' => 'dddDddCC',  's' => 'DddDddCC',  'd' => 'ddd_ddd_cc_',  'ts' => ['Ddd', 'Ddd', 'CC'],  'td' => ['ddd', 'ddd', 'cc_']],
  ['c' => 'dddDddDdd', 's' => 'DddDddDdd', 'd' => 'ddd_ddd_ddd',  'ts' => ['Ddd', 'Ddd', 'Ddd'], 'td' => ['ddd', 'ddd', 'ddd']],
  ['c' => 'dddDddEEE', 's' => 'DddDddEEE', 'd' => 'ddd_ddd_eee_', 'ts' => ['Ddd', 'Ddd', 'EEE'], 'td' => ['ddd', 'ddd', 'eee_']],

  ['c' => 'dddEEE_A',   's' => 'DddEEE_A',   'd' => 'ddd_eee__a',    'ts' => ['Ddd', 'EEE', 'A'],   'td' => ['ddd', 'eee_', 'a']],
  ['c' => 'dddEEEBb',   's' => 'DddEEEBb',   'd' => 'ddd_eee__bb',   'ts' => ['Ddd', 'EEE', 'Bb'],  'td' => ['ddd', 'eee_', 'bb']],
  ['c' => 'dddEEE_CC',  's' => 'DddEEE_CC',  'd' => 'ddd_eee__cc_',  'ts' => ['Ddd', 'EEE', 'CC'],  'td' => ['ddd', 'eee_', 'cc_']],
  ['c' => 'dddEEEDdd',  's' => 'DddEEEDdd',  'd' => 'ddd_eee__ddd',  'ts' => ['Ddd', 'EEE', 'Ddd'], 'td' => ['ddd', 'eee_', 'ddd']],
  ['c' => 'dddEEE_EEE', 's' => 'DddEEE_EEE', 'd' => 'ddd_eee__eee_', 'ts' => ['Ddd', 'EEE', 'EEE'], 'td' => ['ddd', 'eee_', 'eee_']],

  ['c' => 'eee_A_A',   's' => 'EEE_A_A',   'd' => 'eee__a_a',    'ts' => ['EEE', 'A', 'A'],   'td' => ['eee_', 'a', 'a']],
  ['c' => 'eee_ABb',   's' => 'EEE_ABb',   'd' => 'eee__a_bb',   'ts' => ['EEE', 'A', 'Bb'],  'td' => ['eee_', 'a', 'bb']],
  ['c' => 'eee_A_CC',  's' => 'EEE_A_CC',  'd' => 'eee__a_cc_',  'ts' => ['EEE', 'A', 'CC'],  'td' => ['eee_', 'a', 'cc_']],
  ['c' => 'eee_ADdd',  's' => 'EEE_ADdd',  'd' => 'eee__a_ddd',  'ts' => ['EEE', 'A', 'Ddd'], 'td' => ['eee_', 'a', 'ddd']],
  ['c' => 'eee_A_EEE', 's' => 'EEE_A_EEE', 'd' => 'eee__a_eee_', 'ts' => ['EEE', 'A', 'EEE'], 'td' => ['eee_', 'a', 'eee_']],

  ['c' => 'eee_BbA',   's' => 'EEEBbA',   'd' => 'eee__bb_a',    'ts' => ['EEE', 'Bb', 'A'],   'td' => ['eee_', 'bb', 'a']],
  ['c' => 'eee_BbBb',  's' => 'EEEBbBb',  'd' => 'eee__bb_bb',   'ts' => ['EEE', 'Bb', 'Bb'],  'td' => ['eee_', 'bb', 'bb']],
  ['c' => 'eee_BbCC',  's' => 'EEEBbCC',  'd' => 'eee__bb_cc_',  'ts' => ['EEE', 'Bb', 'CC'],  'td' => ['eee_', 'bb', 'cc_']],
  ['c' => 'eee_BbDdd', 's' => 'EEEBbDdd', 'd' => 'eee__bb_ddd',  'ts' => ['EEE', 'Bb', 'Ddd'], 'td' => ['eee_', 'bb', 'ddd']],
  ['c' => 'eee_BbEEE', 's' => 'EEEBbEEE', 'd' => 'eee__bb_eee_', 'ts' => ['EEE', 'Bb', 'EEE'], 'td' => ['eee_', 'bb', 'eee_']],

  ['c' => 'eee_CC_A',   's' => 'EEE_CC_A',   'd' => 'eee__cc__a',    'ts' => ['EEE', 'CC', 'A'],   'td' => ['eee_', 'cc_', 'a']],
  ['c' => 'eee_CCBb',   's' => 'EEE_CCBb',   'd' => 'eee__cc__bb',   'ts' => ['EEE', 'CC', 'Bb'],  'td' => ['eee_', 'cc_', 'bb']],
  ['c' => 'eee_CC_CC',  's' => 'EEE_CC_CC',  'd' => 'eee__cc__cc_',  'ts' => ['EEE', 'CC', 'CC'],  'td' => ['eee_', 'cc_', 'cc_']],
  ['c' => 'eee_CCDdd',  's' => 'EEE_CCDdd',  'd' => 'eee__cc__ddd',  'ts' => ['EEE', 'CC', 'Ddd'], 'td' => ['eee_', 'cc_', 'ddd']],
  ['c' => 'eee_CC_EEE', 's' => 'EEE_CC_EEE', 'd' => 'eee__cc__eee_', 'ts' => ['EEE', 'CC', 'EEE'], 'td' => ['eee_', 'cc_', 'eee_']],

  ['c' => 'eee_DddA',   's' => 'EEEDddA',   'd' => 'eee__ddd_a',    'ts' => ['EEE', 'Ddd', 'A'],   'td' => ['eee_', 'ddd', 'a']],
  ['c' => 'eee_DddBb',  's' => 'EEEDddBb',  'd' => 'eee__ddd_bb',   'ts' => ['EEE', 'Ddd', 'Bb'],  'td' => ['eee_', 'ddd', 'bb']],
  ['c' => 'eee_DddCC',  's' => 'EEEDddCC',  'd' => 'eee__ddd_cc_',  'ts' => ['EEE', 'Ddd', 'CC'],  'td' => ['eee_', 'ddd', 'cc_']],
  ['c' => 'eee_DddDdd', 's' => 'EEEDddDdd', 'd' => 'eee__ddd_ddd',  'ts' => ['EEE', 'Ddd', 'Ddd'], 'td' => ['eee_', 'ddd', 'ddd']],
  ['c' => 'eee_DddEEE', 's' => 'EEEDddEEE', 'd' => 'eee__ddd_eee_', 'ts' => ['EEE', 'Ddd', 'EEE'], 'td' => ['eee_', 'ddd', 'eee_']],

  ['c' => 'eee_EEE_A',   's' => 'EEE_EEE_A',   'd' => 'eee__eee__a',    'ts' => ['EEE', 'EEE', 'A'],   'td' => ['eee_', 'eee_', 'a']],
  ['c' => 'eee_EEEBb',   's' => 'EEE_EEEBb',   'd' => 'eee__eee__bb',   'ts' => ['EEE', 'EEE', 'Bb'],  'td' => ['eee_', 'eee_', 'bb']],
  ['c' => 'eee_EEE_CC',  's' => 'EEE_EEE_CC',  'd' => 'eee__eee__cc_',  'ts' => ['EEE', 'EEE', 'CC'],  'td' => ['eee_', 'eee_', 'cc_']],
  ['c' => 'eee_EEEDdd',  's' => 'EEE_EEEDdd',  'd' => 'eee__eee__ddd',  'ts' => ['EEE', 'EEE', 'Ddd'], 'td' => ['eee_', 'eee_', 'ddd']],
  ['c' => 'eee_EEE_EEE', 's' => 'EEE_EEE_EEE', 'd' => 'eee__eee__eee_', 'ts' => ['EEE', 'EEE', 'EEE'], 'td' => ['eee_', 'eee_', 'eee_']],



  [
    'c' => 'x_HTML_Y_ABC',
    's' => 'X_HTML_Y_ABC',
    'd' => 'x_html__y_abc_',
    'ts' =>  ['X', 'HTML', 'Y', 'ABC'],
    'td' =>  ['x', 'html_', 'y', 'abc_'],
  ],
  [
    'c' => 'aaaBbbCccXDddYEeeZ_KKK_LLL_H_H_MMM_UIView',
    's' => 'AaaBbbCccXDddYEeeZ_KKK_LLL_H_H_MMM_UIView',
    'd' => 'aaa_bbb_ccc_x_ddd_y_eee_z_kkk__lll__h_h_mmm__ui__view',
    'ts' => ['Aaa', 'Bbb', 'Ccc', 'X', 'Ddd', 'Y', 'Eee', 'Z', 'KKK', 'LLL', 'H', 'H', 'MMM', 'UI', 'View'],
    'td' => ['aaa', 'bbb', 'ccc', 'x', 'ddd', 'y', 'eee', 'z', 'kkk_', 'lll_', 'h', 'h', 'mmm_', 'ui_', 'view'],
  ],
  [
    'c' => 'aaaBbbCccXDddYEeePP_H_H_H_MMM_UIViewK',
    's' => 'AaaBbbCccXDddYEeePP_H_H_H_MMM_UIViewK',
    'd' => 'aaa_bbb_ccc_x_ddd_y_eee_pp__h_h_h_mmm__ui__view_k',
    'ts' => ['Aaa', 'Bbb', 'Ccc', 'X', 'Ddd', 'Y', 'Eee', 'PP', 'H', 'H', 'H', 'MMM', 'UI', 'View', 'K'],
    'td' => ['aaa', 'bbb', 'ccc', 'x', 'ddd', 'y', 'eee', 'pp_', 'h', 'h', 'h', 'mmm_', 'ui_', 'view', 'k'],
  ],

  [
    'c'  => 'h_ZZZ_H_H_HZzzH_ZZZTtt',
    's'  => 'H_ZZZ_H_H_HZzzH_ZZZTtt',
    'd'  => 'h_zzz__h_h_h_zzz_h_zzz__ttt',
    'ts' => ['H', 'ZZZ', 'H', 'H', 'H', 'Zzz', 'H', 'ZZZ', 'Ttt'],
    'td' => ['h', 'zzz_', 'h', 'h', 'h', 'zzz', 'h', 'zzz_', 'ttt'],
  ],
  [
    'c'  => 'xAaaBbbXXXCccUDddXX_H_ZZZ_H_H_HZzzH_ZZZTttUIViewXX',
    's'  => 'XAaaBbbXXXCccUDddXX_H_ZZZ_H_H_HZzzH_ZZZTttUIViewXX',
    'd'  => 'x_aaa_bbb_xxx__ccc_u_ddd_xx__h_zzz__h_h_h_zzz_h_zzz__ttt_ui__view_xx_',
    'ts' => ['X', 'Aaa', 'Bbb', 'XXX', 'Ccc', 'U', 'Ddd', 'XX', 'H', 'ZZZ', 'H', 'H', 'H', 'Zzz', 'H', 'ZZZ', 'Ttt', 'UI', 'View', 'XX'],
    'td' => ['x', 'aaa', 'bbb', 'xxx_', 'ccc', 'u', 'ddd', 'xx_', 'h', 'zzz_', 'h', 'h', 'h', 'zzz', 'h', 'zzz_', 'ttt', 'ui_', 'view', 'xx_'],
  ],
  [
    'c' => 'xml_H_ABCRealXYZ_KKKBaseUI_PICK',
    's' =>   'XML_H_ABCRealXYZ_KKKBaseUI_PICK',
    'd' =>   'xml__h_abc__real_xyz__kkk__base_ui__pick_',
    'ts' =>  ['XML', 'H', 'ABC', 'Real', 'XYZ', 'KKK', 'Base', 'UI', 'PICK'],
    'td' =>  ['xml_', 'h', 'abc_', 'real', 'xyz_', 'kkk_', 'base', 'ui_', 'pick_'],
  ],
];

foreach ($testValues as $i => $info) {
  $testValues[$i]['dh'] = preg_replace('/_/', '-', $info['d']);
  $testValues[$i]['ch'] = preg_replace('/_/', '-', $info['c']);
  $testValues[$i]['sh'] = preg_replace('/_/', '-', $info['s']);

  $testValues[$i]['vd'] = '_' . $testValues[$i]['d'];
  $testValues[$i]['vh'] = preg_replace('/_/', '-', $testValues[$i]['vd']);

  $testValues[$i]['tc'] = $info['ts'];
  $testValues[$i]['tc'][0] = $info['td'][0];

  $testValues[$i]['th'] = array_map(
    function($item) {return preg_replace('/_/', '-', $item);},
    $info['td']
  );
}

function _check($got, $right) {
  return $got === $right ? null : [$got, $right];
}

$testCases = [
 "snake_case >> camelCase"   => function($info) {return _check(StewEucen\Acts\IntactCase::camelize($info['d']), $info['c']);},
 "snake_case >> StudlyCaps"  => function($info) {return _check(StewEucen\Acts\IntactCase::studlyCaps($info['d']), $info['s']);},
 "camelCase >> snake_case"   => function($info) {return _check(StewEucen\Acts\IntactCase::delimiterize($info['c']), $info['d']);},
 "StudlyCaps >> snake_case"  => function($info) {return _check(StewEucen\Acts\IntactCase::delimiterize($info['s']), $info['d']);},
 "camelCase >> _snake_case"  => function($info) {return _check(StewEucen\Acts\IntactCase::delimiterize($info['c'], '_', true), $info['d']);},
 "StudlyCaps >> _snake_case" => function($info) {return _check(StewEucen\Acts\IntactCase::delimiterize($info['s'], '_', true), $info['vd']);},
 "camelCase >> chain-case"   => function($info) {return _check(StewEucen\Acts\IntactCase::hyphenated($info['ch']), $info['dh']);},
 "StudlyCaps >> chain-case"  => function($info) {return _check(StewEucen\Acts\IntactCase::hyphenated($info['sh']), $info['dh']);},
 "camelCase >> -chain-case"  => function($info) {return _check(StewEucen\Acts\IntactCase::hyphenated($info['ch']), $info['dh']);},
 "StudlyCaps >> -chain-case" => function($info) {return _check(StewEucen\Acts\IntactCase::hyphenated($info['sh']), $info['dh']);},

 "Tokenize camelCase"                => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['c']), preg_match('/[A-Z]/', $info['c']) ? $info['ts'] : $info['tc']);},
 "Tokenize camelCase as raw first"   => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['c'], '_', true), $info['tc']);},
 "Tokenize StudlyCaps"               => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['s']), $info['ts']);},
 "Tokenize StudlyCaps as raw first"  => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['s'], '_', true), $info['ts']);},
 "Tokenize snake_case"               => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['d']), $info['td']);},
 "Tokenize _snake_case"              => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['d']), $info['td']);},
 "Tokenize snake_case as raw first"  => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['d'], '_', true), $info['td']);},
 "Tokenize _snake_case as raw first" => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['vd'], '_', true), $info['td']);},
 "Tokenize chain-case"               => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['dh'], "-"), $info['th']);},
 "Tokenize -chain-case"              => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['vh'], "-"), $info['th']);},
 "Tokenize chain-case as raw first"  => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['dh'], "-", true), $info['th']);},
 "Tokenize -chain-case as raw first" => function($info) {return _check(StewEucen\Acts\IntactCase::tokenize($info['vh'], "-", true), $info['th']);},

 "Compound from tokens of camelCase"  => function($info) {return _check(StewEucen\Acts\IntactCase::compound($info['tc']), $info['c']);},
 "Compound from tokens of StudlyCaps" => function($info) {return _check(StewEucen\Acts\IntactCase::compound($info['ts']), $info['s']);},
 "Compound from tokens of snake_case" => function($info) {return _check(StewEucen\Acts\IntactCase::compound($info['td']), $info['d']);},
 "Compound from tokens of chain-case" => function($info) {return _check(StewEucen\Acts\IntactCase::compound($info['th'], "-"), $info['dh']);},

 "Capitalize first word'"  => function($info) {return _check(StewEucen\Acts\IntactCase::ucFirst($info['c']), $info['s']);},
 "Uncapitalize first word" => function($info) {return _check(StewEucen\Acts\IntactCase::lcFirst($info['s']), $info['c']);},
];

$errors = [];
foreach ($testCases as $testTitle => $func) {
  $errors[$testTitle] = [];
  foreach ($testValues as $info) {
    $result = $func($info);
    if ($result) {
      array_push($errors[$testTitle], ['values' => $info, 'compared' => $result]);
    }
  }
}

foreach ($errors as $testTitle => $results) {
  if (0 < count($results)) {
    echo "<div>[error] {$testTitle}</div>";
    foreach ($results as $item) {
      $checked = var_export($item['compared'], true);
      echo '<pre>';
      echo "{$item['values']['s']}:\n{$checked}";
      echo '</pre>';
    }
  } else {
    echo "<div>✔ {$testTitle}</div>";
  }
}
