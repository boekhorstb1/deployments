<?php
/**
 * This file specifies which backends people using your installation can log
 * in to.
 *
 * IMPORTANT: DO NOT EDIT THIS FILE!
 * Local overrides MUST be placed in backends.local.php or backends.d/.
 * If the 'vhosts' setting has been enabled in Horde's configuration, you can
 * use backends-servername.php.
 *
 * Example configuration file that enables the Samba backend in favor of the
 * FTP backend and sets a server name for the Samba server:
 *
 * <?php
 * $backends['ftp']['disabled'] = true;
 * $backends['smb']['disabled'] = false;
 * $backends['smb']['params']['hostspec'] = 'FILESERVER HOST';
 *
 * Properties that can be set for each server:
 *   - attributes: (array) The list of attributes that the driver supports.
 *       + 'edit'
 *       + 'download'
 *       + 'group'
 *       + 'modified'
 *       + 'name'
 *       + 'owner'
 *       + 'permission'
 *       + 'size'
 *       + 'type'
 *   - createhome: (boolean) If this parameter is set to true, and the home
 *                 directory does not exist, attempt to create the home
 *                 directory on login.
 *   - driver: (string) The VFS (Virtual File System) driver to use.
 *             (See below examples for additional parameters needed.)
 *       + file: Access a local file system.
 *       + ftp: Connect to a FTP server.
 *       + smb: Connect to a SMB fileshare.
 *       + sql: Connect to VFS filesystem stored in SQL database.
 *       + ssh2: Connect to a remote server via SSH2.
 *   - filter: (string) If set, all files that match the regex will be hidden
 *             in the folder view.  The regex must be in PCRE syntax (see
 *             http://www.php.net/pcre).
 *   - home: (string) The directory that will be used as home directory for the
 *           user. This parameter will overrule a home parameter in the params.
 *           If empty, this will default to the active working directory
 *           immediately after logging into the VFS backend (i.e. for ftp,
 *           this will most likely be ~user, for SQL based VFS backends,
 *           this will probably be the root directory).
 *   - hordeauth: (mixed) One of the following values:
 *       + true: Gollem will attempt to use the user's existing credentials
 *               (the username/password they used to log in to Horde) to login
 *               to this source.
 *       + false: [DEFAULT] Everything after and including the first @ in the
 *                username will be stripped off before attempting
 *                authentication.
 *       + 'full': The username will be used unmodified.
 *   - loginparams: (array) A list of parameters that can be changed by the
 *                  user on the login screen.  The key is the parameter name
 *                  that can be changed, the value is the text that will be
 *                  displayed next to the entry box on the login screen.
 *   - name: (string) This is the name displayed in the server list on the
 *           login screen.
 *   - quota: (string) If set, turn on VFS quota checking for the backend (if
 *            supported). Supported values:
 *       + false: [DEFAULT] Quota is disabled.
 *       + 'size [metric]': Quota value. Metric can be one of the following:
 *           - B: bytes [DEFAULT]
 *           - KB: kilobytes
 *           - MB: megabytes
 *           - GB: gigabytes
 *         Examples: "2 MB", "2048 B", "1.5 GB"
 *   - shares: (boolean) Whether to enable share support for this backend.
 *             This allows flexible file sharing independent from the
 *             permission support in the storage backend. For sharing to work
 *             properly, you need a backend type that does not implicitly
 *             enforce user permissions, and individual home directories for
 *             each user.
 *   - root: (string) The directory that will be the "top" or "root" directory,
 *           being the topmost directory where users can change to. This is in
 *           addition to any 'vfsroot' parameter set in the params array.
 *
 * *** The following options should NOT be set unless you REALLY know what ***
 * *** you are doing! FOR MOST PEOPLE, AUTO-DETECTION OF THESE PARAMETERS  ***
 * *** (the default if the parameters are not set) SHOULD BE USED!         ***
 *
 *   - preferred: (string or array) Useful if you want to use the same
 *                backends.php file for different machines. If the hostname of
 *                the Gollem machine is identical to one of those in the
 *                preferred list, then that entry will be selected by default
 *                on the login screen. Otherwise the first entry in the list
 *                is selected.
 */

// FTP Example.
$backends['ftp']['disabled'] = true;

// NOTE: /exampledir/home and all subdirectories should be, for
// security reasons, owned by your web server user and mode 700 or you
// will need to use suexec or something else that can adjust the web
// server effective uid.
$backends['file'] = array(
    // Disabled by default
    'disabled' => false,
    'name' => 'Virtual Home Directories',
    'driver' => 'file',
    'hordeauth' => true,
    'params' => array(
        // The base location under which the user home directories live.
        'vfsroot' => '/srv/www/horde/var/vfs/gollem/users/',
        // The default permissions to set for newly created folders and files.
        // 'permissions' => '750'
    ),
    'loginparams' => array(),
    'root' => '/',
    'home' => $GLOBALS['registry']->getAuth(),
    // 'createhome' => false,
    // 'filter' => '^regex$',
    // 'quota' => false,
    'shares' => true,
    'attributes' => array(
        'type',
        'name',
        'share',
        'edit',
        'download',
        'modified',
        'size',
    )
);

