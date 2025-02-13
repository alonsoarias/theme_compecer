<?php
// This file is part of Moodle - http://moodle.org/
// 
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// 
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Archivo de idioma.
 *
 * @package    theme_compecer
 * @copyright  2024 IngeWeb https://www.ingeweb.co
 * @author     Pedro Arias <soporte@ingeweb.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// General
$string['pluginname']        = 'Compecer';
$string['choosereadme']       = 'Compecer es un tema creado por IngeWeb exclusivamente para nuestros clientes.';
$string['configtitle']       = 'Configuración de Compecer';
$string['themesettings']     = 'Ajustes del Tema';
$string['region-side-pre']   = 'Derecha';

// Encabezados de sección (versión actual)
$string['generalsettings']    = 'Ajustes Generales';
$string['slidersettings']     = 'Ajustes del Slider';
$string['aboutsettings']      = 'Ajustes de Acerca de';
$string['careersettings']     = 'Ajustes de Carrera';
$string['loginsettings']      = 'Ajustes de Inicio de Sesión';
$string['categoriessettings'] = 'Ajustes de Categorías';

// Encabezados de sección (adicionales de la versión inicial)
$string['themesettingsgeneral']         = 'Ajustes Generales';
$string['themesettingsgeneraldesc']     = 'Opciones generales de configuración del tema';
$string['themesettingschat']            = 'Ajustes de Chat';
$string['themesettingschatdesc']        = 'Configura las opciones de integración del chat';
$string['themesettingsaccessibility']   = 'Ajustes de Accesibilidad';
$string['themesettingsaccessibilitydesc'] = 'Configura las opciones de accesibilidad';
$string['themesettingscopypaste']       = 'Ajustes de Copiar/Pegar';
$string['themesettingscopypaste_desc']  = 'Configura las restricciones de copiar y pegar';
$string['themesettingslogin']           = 'Ajustes de Inicio de Sesión';
$string['themesettingslogindesc']       = 'Configura la apariencia de la página de inicio de sesión';
$string['themesettingsabout']           = 'Ajustes de Acerca de';
$string['themesettingsaboutdesc']       = 'Configura los ajustes de la sección Acerca de';

// Ajustes generales
$string['themeinfotext']         = 'Este tema fue creado para <strong>otro proyecto de Moodle</strong> por <a target="_blank" href="http://ingeweb.co/">IngeWeb - Soluciones para triunfar en Internet</a>.';
$string['generalnoticemode']     = 'Modo de Notificación';
$string['generalnoticemodedesc'] = 'La notificación general fue creada para permitir que los administradores muestren avisos importantes en el encabezado de cada página tras iniciar sesión.';
$string['generalnoticemode_off'] = 'Desactivado';
$string['generalnoticemode_info'] = 'Información';
$string['generalnoticemode_danger'] = 'Crítico';
$string['generalnotice']         = 'Texto de la notificación';
$string['generalnoticedesc']     = 'Texto que se mostrará dentro del recuadro de aviso';
$string['generalnotice_create']  = 'Establecer un aviso';
$string['generalnoticedefault']  = '<strong>Estamos trabajando</strong> para mejorar. La plataforma puede presentar comportamientos extraños en ocasiones.';

// Alternar visibilidad de secciones
$string['enable_slider']              = 'Activar sección del slider';
$string['enable_sliderdesc']          = 'Activa o desactiva la sección del slider en la página principal';
$string['enable_about']               = 'Activar sección Acerca de';
$string['enable_aboutdesc']           = 'Activa o desactiva la sección Acerca de en la página principal';
$string['enable_search_categories']   = 'Activar sección de búsqueda y categorías';
$string['enable_search_categoriesdesc'] = 'Activa o desactiva la sección de búsqueda y categorías en la página principal';

// Ajustes de Tarjetas del Panel
$string['mydashboardsettings']        = 'Ajustes de Tarjetas del Panel';
$string['enable_dashboard_cards']     = 'Activar Tarjetas del Panel';
$string['enable_dashboard_cardsdesc'] = 'Activa o desactiva la sección de tarjetas del panel';
$string['dashboard_card_heading']     = 'Tarjeta del Panel {$a}';
$string['dashboard_card_visibility']  = 'Mostrar Tarjeta {$a}';
$string['dashboard_card_visibilitydesc'] = 'Activa o desactiva la tarjeta del panel {$a}';
$string['dashboard_card_title']       = 'Título de la Tarjeta {$a}';
$string['dashboard_card_titledesc']   = 'Introduce el título para la tarjeta del panel {$a}';
$string['dashboard_card_subtitle']    = 'Subtítulo de la Tarjeta {$a}';
$string['dashboard_card_subtitledesc']= 'Introduce el subtítulo para la tarjeta del panel {$a}';
$string['dashboard_card_url']         = 'URL de la Tarjeta {$a}';
$string['dashboard_card_urldesc']     = 'Introduce la URL para la tarjeta del panel {$a}';
$string['dashboard_card_color']       = 'Color de la Tarjeta {$a}';
$string['dashboard_card_colordesc']   = 'Elige el color para la tarjeta del panel {$a}';
$string['dashboard_card_icon']        = 'Ícono de la Tarjeta {$a}';
$string['dashboard_card_icondesc']    = 'Elige el ícono para la tarjeta del panel {$a}';

// Ajustes de Chat
$string['enable_chat']              = 'Activar widget de chat';
$string['enable_chatdesc']          = 'Activa la integración del widget de chat Tawk.to';
$string['tawkto_embed_url']         = 'URL de Tawk.to';
$string['tawkto_embed_urldesc']     = 'Introduce la URL de tu propiedad de Tawk.to (por ejemplo, https://embed.tawk.to/TU_ID/default)';
$string['tawkto_embed_urldefault']  = 'https://embed.tawk.to/TU_ID_DEFAULT/default';

// Ajustes de Accesibilidad
$string['accessibility_widget']     = 'Activar widget de accesibilidad';
$string['accessibility_widgetdesc'] = 'Activa o desactiva el widget de soporte de accesibilidad';

// Ajustes de Copiar/Pegar
$string['copypaste_prevention']     = 'Activar prevención de copiar/pegar';
$string['copypaste_preventiondesc'] = 'Evita copiar y pegar contenido para roles seleccionados';
$string['copypaste_roles']          = 'Roles Restringidos';
$string['copypaste_rolesdesc']      = 'Selecciona los roles a los que se les deben aplicar restricciones de copiar/pegar';

// Página de inicio de sesión
$string['loginbg_image']     = 'Imagen de fondo de inicio de sesión';
$string['loginbg_imagedesc'] = 'Sube una imagen de fondo para la página de inicio de sesión';
$string['loginbg_color']     = 'Color de fondo de inicio de sesión';
$string['loginbg_colordesc'] = 'Color de fondo en la página de inicio de sesión';
$string['credit']            = 'Tema creado por <a target="_blank" class="my-credit-link" href="http://ingeweb.co/">www.ingeweb.co</a>';

// Cadenas del Slider
$string['slidercount']       = 'Número de diapositivas';
$string['slidercountdesc']   = 'Selecciona cuántas diapositivas deseas añadir';
$string['sliderimage']       = 'Imagen de la diapositiva {$a}';
$string['sliderimagedesc']   = 'Añade una imagen para esta diapositiva';
$string['slidertitle']       = 'Título de la diapositiva {$a}';
$string['slidertitledesc']   = 'Añade un título para esta diapositiva';
$string['slidercaption']     = 'Subtítulo de la diapositiva {$a}';
$string['slidercaptiondesc'] = 'Añade un subtítulo para esta diapositiva';
$string['slidertitledefault'] = 'Título predeterminado de la diapositiva {$a}';
$string['slidercaptiondefault'] = 'Subtítulo predeterminado de la diapositiva {$a}';

// Cadenas de la sección Acerca de
$string['abouttitle']         = 'Título Acerca de';
$string['abouttitledesc']     = 'El título para tu sección Acerca de';
$string['aboutcontent']       = 'Contenido Acerca de';
$string['aboutcontentdesc']   = 'El contenido principal de tu sección Acerca de';
$string['abouttitledefault']  = 'Quiénes Somos';
$string['aboutcontentdefault']= 'Añade la descripción de tu organización aquí';

// Cadenas de la sección de Carrera
$string['careersection_title']      = 'Invierte en tu Carrera';
$string['enablecareerboxes']        = 'Activar Cajas de Carrera';
$string['enablecareerboxesdesc']    = 'Activa o desactiva la sección de cajas de carrera';
$string['careerboxcount']           = 'Número de cajas de carrera';
$string['careerboxcountdesc']       = 'Selecciona cuántas cajas de carrera mostrar (1-6)';
$string['careerboxesbgcolor']       = 'Color de fondo de la sección de carrera';
$string['careerboxesbgcolordesc']   = 'Establece el color de fondo para la sección de carrera';
$string['careerboxicon']            = 'Ícono de la caja {$a}';
$string['careerboxicondesc']        = 'Selecciona un ícono para esta caja de carrera';
$string['careerboxtitle']           = 'Título de la caja {$a}';
$string['careerboxtitledesc']       = 'Introduce el título para esta caja de carrera';
$string['careerboxcontent']         = 'Contenido de la caja {$a}';
$string['careerboxcontentdesc']     = 'Introduce el contenido para esta caja de carrera';
$string['careerboxtitledefault']    = 'Camino de Carrera {$a}';
$string['careerboxcontentdefault']  = 'Describe el camino de carrera {$a} aquí';

// Cadenas de Búsqueda y Categorías
$string['selectedcategories']         = 'Categorías Seleccionadas';
$string['selectedcategoriesdesc']     = 'Elige qué categorías mostrar en la página principal';
$string['searchcourses']              = 'Buscar cursos';
$string['searchsectiontitle']         = 'Título de la Sección de Búsqueda';
$string['searchsectiontitledesc']     = 'Título para la sección de búsqueda';
$string['searchsectiontitledefault']  = 'Encuentra tu curso';
$string['searchsectiondesc']          = 'Descripción de la Sección de Búsqueda';
$string['searchsectiondescdesc']      = 'Texto descriptivo para la sección de búsqueda';
$string['searchsectiondescdefault']   = 'Busca entre nuestra amplia gama de cursos';
$string['categoriesbgcolor']          = 'Color de fondo de las categorías';
$string['categoriesbgcolordesc']      = 'Color de fondo para la sección de categorías';

// Nombres de pestañas adicionales (versión inicial)
$string['chatsettings']          = 'Ajustes de Chat';
$string['accessibilitysettings'] = 'Ajustes de Accesibilidad';
$string['copypastesettings']     = 'Ajustes de Copiar/Pegar';

// Cadenas de Iconos
$string['icon_message']      = 'Mensaje';
$string['icon_user']         = 'Usuario';
$string['icon_settings']     = 'Configuración';
$string['icon_chart_line']   = 'Gráfico de líneas';
$string['icon_chart_bar']    = 'Gráfico de barras';
$string['icon_graduation']   = 'Birrete';
$string['icon_book']         = 'Libro';
$string['icon_laptop']       = 'Portátil';
$string['icon_users']        = 'Usuarios';
$string['icon_globe']        = 'Globo';
$string['icon_lightbulb']    = 'Bombilla';
$string['icon_chart']        = 'Gráfico de líneas';
$string['icon_medal']        = 'Medalla';
$string['icon_certificate']  = 'Certificado';
$string['icon_star']         = 'Estrella';
$string['icon_rocket']       = 'Cohete';
$string['icon_code']         = 'Código';
$string['icon_microscope']   = 'Microscopio';
$string['icon_flask']        = 'Frasco';
$string['icon_atom']         = 'Átomo';
$string['icon_brain']        = 'Cerebro';
$string['icon_university']   = 'Universidad';
$string['icon_award']        = 'Premio';
$string['icon_usergraduate'] = 'Graduado';
$string['icon_teacher']      = 'Profesor';

// Iconos adicionales
$string['icon_bookreader']   = 'Lector de libros';
$string['icon_bookopen']     = 'Libro abierto';
$string['icon_books']        = 'Libros';
$string['icon_pen']          = 'Pluma';
$string['icon_pencil']       = 'Lápiz';
$string['icon_marker']       = 'Marcador';
$string['icon_highlighter']  = 'Resaltador';
$string['icon_desktop']      = 'Escritorio';
$string['icon_laptopcode']   = 'Portátil con código';
$string['icon_mobile']       = 'Teléfono móvil';
$string['icon_tablet']       = 'Tableta';
$string['icon_keyboard']     = 'Teclado';
$string['icon_mouse']        = 'Ratón';
$string['icon_wifi']         = 'WiFi';
$string['icon_signal']       = 'Señal';
$string['icon_dna']          = 'ADN';
$string['icon_vial']         = 'Vial';
$string['icon_magnet']       = 'Imán';
$string['icon_glasses']      = 'Gafas';
$string['icon_telescope']    = 'Telescopio';
$string['icon_briefcase']    = 'Portafolios';
$string['icon_calculator']   = 'Calculadora';
$string['icon_calendar']     = 'Calendario';
$string['icon_clock']        = 'Reloj';
$string['icon_tasks']        = 'Tareas';
$string['icon_clipboard']    = 'Portapapeles';
$string['icon_clipboardcheck'] = 'Verificación del portapapeles';
$string['icon_clipboardlist']  = 'Lista del portapapeles';
$string['icon_comments']       = 'Comentarios';
$string['icon_commentdots']    = 'Puntos de comentario';
$string['icon_envelope']       = 'Sobre';
$string['icon_bell']           = 'Campana';
$string['icon_broadcast']      = 'Torre de transmisión';
$string['icon_bullhorn']       = 'Megáfono';
$string['icon_trophy']         = 'Trofeo';
$string['icon_crown']          = 'Corona';
$string['icon_badge']          = 'Insignia';
$string['icon_stamp']          = 'Sello';
$string['icon_palette']        = 'Paleta';
$string['icon_paintbrush']     = 'Pincel';
$string['icon_music']          = 'Música';
$string['icon_theater']        = 'Máscaras de teatro';
$string['icon_film']           = 'Película';
$string['icon_camera']         = 'Cámara';
$string['icon_running']        = 'Corriendo';
$string['icon_swimming']       = 'Piscina';
$string['icon_basketball']     = 'Baloncesto';
$string['icon_football']       = 'Fútbol';
$string['icon_heartbeat']      = 'Latido del corazón';
$string['icon_medkit']         = 'Botiquín';
$string['icon_compass']        = 'Brújula';
$string['icon_map']            = 'Mapa';
$string['icon_mapmarker']      = 'Marcador de mapa';
$string['icon_directions']     = 'Direcciones';
$string['icon_location']       = 'Ubicación (flecha)';
$string['icon_handshelping']   = 'Manos ayudando';
$string['icon_handshake']      = 'Apretón de manos';
$string['icon_userfriends']    = 'Amigos de usuario';
$string['icon_userplus']       = 'Agregar usuario';
$string['icon_userscog']       = 'Configuración de usuario';
$string['icon_peoplecarry']    = 'Personas cargando';

// Cadenas de Visibilidad
$string['show']                    = 'Mostrar';
$string['hide']                    = 'Ocultar';
$string['config_visibility']       = 'Visibilidad';
$string['config_visibility_desc']  = 'Mostrar u ocultar este elemento';
$string['config_title']            = 'Título';
$string['config_title_desc']       = 'Introduce el título para este elemento';
$string['config_subtitle']         = 'Subtítulo';
$string['config_subtitle_desc']    = 'Introduce el subtítulo para este elemento';
$string['config_link']             = 'URL del enlace';
$string['config_link_desc']        = 'Introduce la URL a la que debe enlazar este elemento';
$string['config_color']            = 'Color';
$string['config_color_desc']       = 'Elige el color para este elemento';
$string['config_icon_class']       = 'Ícono';
$string['config_icon_class_desc']  = 'Elige el ícono para este elemento';

// Cadenas de Caché
$string['cachedef_fontawesomemooveiconmapping'] = 'Mapeo de íconos de la fuente del tema';
$string['breadcrumb'] = 'Migas de pan';
