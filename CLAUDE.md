# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Chubes Theme** is a custom WordPress theme for https://chubes.net, serving as Chris Huber's showcase for AI-first WordPress development, music journalism, and content automation systems.

## Development Commands

This theme uses traditional WordPress development with automated build system:

- **Bash build script** - `build.sh` creates production WordPress theme packages
- **No package.json** - Direct CSS/JS editing without Node.js tooling
- **Asset cache busting** - Uses `filemtime()` for dynamic versioning
- **Local development** - Uses Local Sites environment
- **No automated testing** - Manual testing required

### Build Process
```bash
# Create production theme package
./build.sh

# Outputs:
# /dist/chubes.zip - For WordPress admin upload
# /dist/chubes/ - For FTP deployment
```

## Architecture Overview

### Core Structure
- **Traditional WordPress theme** with modular PHP organization
- **Custom post types**: Journal, Game, Documentation
- **Codebase taxonomy**: Hierarchical organization for documentation
- **Contact form system** with anti-spam protection
- **Manual asset management** with conditional loading

### Directory Structure
```
/chubes/
├── /templates/ - Organized template files by type:
│   ├── /parts/ - Template parts organized by functionality
│   │   └── /codebase/ - Codebase-specific components
│   │       └── codebase-card.php - Individual codebase item display
│   ├── /archive/ - All archive templates
│   │   ├── archive.php - Generic archive template with dynamic headers
│   │   ├── archive-journal.php - Journal archive
│   │   ├── archive-codebase.php - Codebase taxonomy archive
│   │   ├── archive-documentation.php - Documentation archive
│   │   ├── archive-docs-category.php - Documentation category archive
│   │   ├── archive-docs-taxonomy.php - Documentation taxonomy archive
│   │   └── search.php - Search results template
│   ├── /single/ - All single post templates
│   │   ├── single.php - Default single post template
│   │   └── single-documentation.php - Documentation single view
│   ├── /page/ - All page templates
│   │   ├── page.php - Default page template
│   │   └── page-contact.php - Contact page template
│   ├── /taxonomy/ - All taxonomy templates
│   │   └── taxonomy-codebase.php - Individual codebase taxonomy pages
│   ├── 404.php - Custom 404 error page
│   ├── front-page.php - Homepage template
│   ├── home.php - Blog posts index template
│   └── index.php - Default template
├── /assets/
│   ├── /css/ - Page-specific stylesheets
│   ├── /js/ - JavaScript for navigation and interactions  
│   └── /fonts/ - Custom fonts (Inter, Space Grotesk) + SVG icons
├── /inc/ - Modular PHP functionality:
│   ├── breadcrumbs.php - Navigation breadcrumb system
│   ├── contact-ajax.php - Contact form implementation
│   ├── /core/ - Core WordPress functionality:
│   │   ├── custom-post-types.php - Journal, Game, Documentation CPTs
│   │   ├── custom-taxonomies.php - Codebase taxonomy registration
│   │   ├── rewrite-rules.php - Custom URL rewrite rules for documentation
│   │   ├── filters.php - Template hierarchy filters for organized template loading
│   │   └── related-posts.php - Related posts functionality
│   ├── /plugins/ - Codebase tracking system with taxonomy fields
│   └── /utils/ - Instagram embeds
├── /dist/ - Production build directory with optimized theme files
└── functions.php - Theme setup, navigation, & asset loading
```

### Template Hierarchy System

The theme uses WordPress template hierarchy filters to organize templates into logical subdirectories within `/templates/`. All template lookups are redirected via `/inc/core/filters.php`:

- **Archive templates** → `/templates/archive/` (archive.php, archive-journal.php, etc.)
- **Single post templates** → `/templates/single/` (single.php, single-documentation.php)  
- **Page templates** → `/templates/page/` (page.php, page-contact.php)
- **Taxonomy templates** → `/templates/taxonomy/` (taxonomy-codebase.php)
- **Root-level templates** → `/templates/` (404.php, front-page.php, home.php, index.php)

This system maintains WordPress template hierarchy while enabling organized file structure.

### Key Systems

#### Contact System
Simple, secure contact form system:
- Single contact form with honeypot/timestamp spam protection
- AJAX submission with user feedback
- Sends both admin and user notification emails
- WordPress nonce security and input sanitization

#### Codebase Documentation & Tracking System
- **Documentation CPT** with codebase taxonomy organization
- **Unified codebase taxonomy** (replaces separate plugin/theme taxonomies)
- **Hierarchical project structure** (plugins → project-name → categories)
- **Repository information tracking** for GitHub and WordPress.org projects
- **Install count tracking** for WordPress plugins and themes
- **Admin interface** with manual update controls and statistics
- **Custom admin columns** showing full taxonomy hierarchy path
- **Card-based public archive** with dynamic content type buttons
- **Public codebase archive** with project information and statistics

### Asset Loading Patterns

CSS/JS conditionally loaded in `functions.php`:
- **Front page**: `home.css`
- **Documentation posts**: `documentation.css` for single documentation view
- **Archive pages**: `archives.css` for all archive and taxonomy pages
- **Global**: `navigation.js` for mobile menu functionality

*Note: Contact assets (`contact.css`, `contact.js`) exist but are not currently enqueued in functions.php - they would need to be manually included or the enqueue system updated to load them conditionally for contact pages.*

### Data Passing Convention
PHP to JS data uses `wp_localize_script` with naming pattern:
- `*_params` or `*_vars` (e.g., `chubes_vars`)

### Custom Post Types & Taxonomy
- **Journal** (`/journal`) - Blog-style content
- **Game** (`/game`) - Interactive game hosting
- **Documentation** (`/docs`) - Plugin guides and tutorials
- **Codebase taxonomy** (`/codebase`) - Hierarchical organization for documentation

### Navigation System
Advanced parent page navigation with dynamic breadcrumb support:
- **Context-aware back navigation** (Blog posts → Blog, Documentation → Docs, etc.)
- **Hierarchical page support** with ancestor detection
- **Custom post type archive detection**
- Breadcrumb functionality in `/inc/breadcrumbs.php`

## Recent Major Changes

Based on git history and current implementation:
- **Theme restructuring** (removed old PHP directory/autoloader)
- **Asset reorganization** (moved CSS/fonts from root to `/assets/`)
- **Template system reorganization** (moved templates to `/templates/` with hierarchy filters)
- **New template additions** (organized in subdirectories with dynamic headers)
- **Codebase system expansion** (Documentation CPT, unified Codebase taxonomy, repository tracking)
- **New archive templates** (`archive-codebase.php`, `archive-documentation.php`, `taxonomy-codebase.php`)
- **Enhanced codebase tracking** (repository integration, admin interface, taxonomy fields)
- **Advanced navigation system** (parent page detection, dynamic breadcrumbs)
- **Template hierarchy filters** (organized template loading via `/inc/core/filters.php`)
- **Documentation admin columns** (full taxonomy hierarchy display instead of simple terms)
- **Card-based archive layouts** (using `codebase-card.php` template part with dynamic content buttons)
- **CSS enqueuing fixes** (archives.css properly loads on taxonomy pages)
- **Build system** (comprehensive production packaging via `build.sh`)

## Development Guidelines

### Development Documentation
Project documentation is maintained in:
- `CLAUDE.md` - Current codebase architecture and guidance
- `README.md` - Developer setup and overview

### Code Conventions
- **Build system available** - `build.sh` for production deployment
- **Direct file editing** - no Node.js build pipeline
- **Modular PHP** - organized by feature in `/inc/`
- **Security practices** - honeypot protection, nonce verification
- **Performance optimizations** - disabled emojis, removed WP version

### Common Development Tasks
- **Template modifications**: Edit files in `/templates/` subdirectories, organized by type
- **Template hierarchy changes**: Modify `/inc/core/filters.php` for new template organization
- **Contact form modifications**: Update `/inc/contact-ajax.php` and contact page assets
- **Asset changes**: Edit directly in `/assets/`, cache-busting automatic via `filemtime()`
- **Custom post type changes**: Modify `/inc/core/custom-post-types.php` and `/inc/core/custom-taxonomies.php`
- **Codebase system changes**: Work with `/inc/plugins/codebase-repository-info-fields.php` and `/inc/plugins/track-codebase-installs.php` for unified tracking system
- **Admin column customization**: Modify hierarchy display functions in `/inc/core/custom-taxonomies.php`

## Important Notes

- **No automated testing framework** - manual verification required
- **No CSS preprocessors** - vanilla CSS organization
- **WordPress.org plugin API integration** for install tracking
- **Security focused** - version hiding, spam protection, nonce verification
- **Performance optimized** - selective asset loading, emoji disabled