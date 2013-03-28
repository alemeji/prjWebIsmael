@echo off

rem -------------------------------------------------------------
rem  Yii command line script for Windows.
rem
rem  This is the bootstrap script for running yiic on Windows.
rem
rem  @author Qiang Xue <qiang.xue@gmail.com>
rem  @link http://www.yiiframework.com/
rem  @copyright Copyright &copy; 2008 Yii Software LLC
rem  @license http://www.yiiframework.com/license/
rem  @version $Id$
rem -------------------------------------------------------------

@setlocal

rem set YII_PATH=%~dp0

set YII_PATH=C:\Program Files (x86)\EasyPHP-12.1\www\yii\framework\

rem if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

if "%PHP_COMMAND%" == "" set PHP_COMMAND=C:\Program Files (x86)\EasyPHP-12.1\php\php546x130113114608\php.exe

"%PHP_COMMAND%" "%YII_PATH%yiic" %*

@endlocal