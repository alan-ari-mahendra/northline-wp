---
name: Quiet Editorial Operations
colors:
  surface: '#f9f9ff'
  surface-dim: '#d3daea'
  surface-bright: '#f9f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f0f3ff'
  surface-container: '#e7eefe'
  surface-container-high: '#e2e8f8'
  surface-container-highest: '#dce2f3'
  on-surface: '#151c27'
  on-surface-variant: '#45464d'
  inverse-surface: '#2a313d'
  inverse-on-surface: '#ebf1ff'
  outline: '#75777e'
  outline-variant: '#c5c6ce'
  surface-tint: '#525e7d'
  primary: '#000a24'
  on-primary: '#ffffff'
  primary-container: '#14213d'
  on-primary-container: '#7c89aa'
  inverse-primary: '#b9c6ea'
  secondary: '#006a60'
  on-secondary: '#ffffff'
  secondary-container: '#8cf5e4'
  on-secondary-container: '#007166'
  tertiary: '#110a00'
  on-tertiary: '#ffffff'
  tertiary-container: '#2c2000'
  on-tertiary-container: '#a58532'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d9e2ff'
  primary-fixed-dim: '#b9c6ea'
  on-primary-fixed: '#0d1b36'
  on-primary-fixed-variant: '#3a4664'
  secondary-fixed: '#8cf5e4'
  secondary-fixed-dim: '#6fd8c8'
  on-secondary-fixed: '#00201c'
  on-secondary-fixed-variant: '#005048'
  tertiary-fixed: '#ffdf96'
  tertiary-fixed-dim: '#e7c268'
  on-tertiary-fixed: '#251a00'
  on-tertiary-fixed-variant: '#5a4400'
  background: '#f9f9ff'
  on-background: '#151c27'
  surface-variant: '#dce2f3'
typography:
  display-xl:
    fontFamily: Newsreader
    fontSize: 56px
    fontWeight: '400'
    lineHeight: 64px
    letterSpacing: -0.02em
  display-xl-mobile:
    fontFamily: Newsreader
    fontSize: 38px
    fontWeight: '400'
    lineHeight: 46px
    letterSpacing: -0.015em
  headline-lg:
    fontFamily: Newsreader
    fontSize: 40px
    fontWeight: '400'
    lineHeight: 48px
    letterSpacing: -0.015em
  headline-lg-mobile:
    fontFamily: Newsreader
    fontSize: 30px
    fontWeight: '400'
    lineHeight: 38px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Newsreader
    fontSize: 28px
    fontWeight: '400'
    lineHeight: 36px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Newsreader
    fontSize: 22px
    fontWeight: '400'
    lineHeight: 30px
  title-editorial:
    fontFamily: Newsreader
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 26px
    letterSpacing: 0.01em
  body-lg:
    fontFamily: DM Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: DM Sans
    fontSize: 15px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: DM Sans
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 20px
  label-editorial:
    fontFamily: DM Sans
    fontSize: 11px
    fontWeight: '500'
    lineHeight: 16px
    letterSpacing: 0.08em
  numeral-accent:
    fontFamily: Newsreader
    fontSize: 24px
    fontWeight: '400'
    lineHeight: 28px
    letterSpacing: 0.02em
spacing:
  gutter: 1.5rem
  gutter-desktop: 2.5rem
  margin: 1.25rem
  margin-desktop: 4rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2.5rem
  space-2xl: 4rem
  space-3xl: 6rem
---

## Brand & Style

This design system embodies the calculated precision, understatement, and high-craft sensibilities of an elite northern British operations consultancy. It balances rigorous organizational clarity with the tactile elegance of broadsheet publishing and high-end industrial reportage. The tone is deliberate, intellectual, and unhurried—rejecting tech-industry hyperbole, decorative SaaS trends, and superficial gloss in favor of structural clarity, typography-driven authority, and measured space.

The visual execution is grounded in **Editorial Minimalism**:
- **Tactile Paper Reality**: Backgrounds carry the quiet temperature of heavy, uncoated archival stock rather than cold clinical screens.
- **Typographic Rigor**: Hierarchy is established purely through scale, proportion, serif display weight, and precise letter spacing. Content reads as structured briefs, analytical memoranda, and monograph spreads.
- **Asymmetric Tension**: Architectural layouts prioritize generous negative margins, asymmetrical column distributions, hairline rule lines, and structured running-headers.
- **Absence of Superficial Ornament**: Explicit prohibition against gradients, soft blur drop-shadows, glassmorphic translucency, floating neo-brutalist extrusions, or decorative iconography.

## Colors

The color palette draws from traditional print production, dark fountain pen ink, bookcloth binding, and fine archival stock.

### Palette Architecture
- **Primary Ink (`#14213D`)**: Deep rich ink blue. Replaces harsh synthetic blacks for all primary typography, structural borders, authoritative callouts, and solid actionable elements.
- **Secondary Accent (`#2A9D8F`)**: Subdued editorial teal. Reserved for precise status flags, discrete micro-indicators, metadata highlights, and quiet interactive focus states.
- **Hairline Sand (`#E9C46A`)**: Used strictly as a micro-accent. It is strictly limited to 1px hairline rule dividers, index numbers, thin chart axes, and bespoke typographic numerals. It must never appear as a broad background surface fill.
- **Subdued Slate (`#6B7280`)**: Neutral tone for secondary narrative, footnotes, table metadata, structural running titles, and de-emphasized structural lines.
- **Canvas Base (`#FAFAF7`)**: Warm paper ground providing an organic, non-glare, tactile foundation for the entire reading experience.

### Color Rules & Prohibitions
1. Never use saturated multi-step color fills, vibrant glows, or decorative chromatic gradients.
2. Background contrast relies on strict shifts between `#FAFAF7` and crisp white `#FFFFFF` surface cards, divided only by 1px rules tinted with `#14213D` (at low opacities) or `#E9C46A`.
3. Informational states (success, notice, caution) must be rendered through deliberate typographic titling, bracketed labels, or quiet tonal badges rather than neon warning banners.

## Typography

The typographic hierarchy pairs a literary, transitional serif with a crisp, low-contrast grotesque to establish an intellectual, authoritative presence.

### Typographic Principles
- **Headlines & Editorial Titles**: Rendered in the serif typeface. Titles evoke the craft of independent analytical journals and monographs. Italicized cuts are reserved for intentional emphasis, definitions, and pull-quotes.
- **Body & Data**: Built upon `DM Sans`. Set with generous leading to support sustained reading of operational narratives, procedural flows, and system audits.
- **Labeling & Metadata**: Set in uppercase `DM Sans` at 11px with wide letter tracking (`0.08em`). Used for categorizations, folio stamps, step headers, and audit dates.
- **Tabular Figures & Numerals**: When displaying statistics, indexed sequencing, or currency metrics, numbers adopt the serif style or strict proportional lining to reinforce audit reliability.

## Layout & Spacing

Layouts follow structural editorial guidelines: asymmetric column grids, deliberate negative space, and disciplined horizontal baseline alignments.

### Layout Philosophy & Grid System
- **12-Column Asymmetric Framework**: Desktop layouts run across a 12-column grid inside a maximum container width of 1280px. Columns are frequently combined into asymmetric pairs (e.g., a 4-column contextual margin on the left paired with an 8-column analytical narrative on the right).
- **Folio Headers & Margin Running Notes**: Wide top and side margins host archival folio markers, issue dates, and section identifiers.
- **Rhythm & Rules**: Structural breaks rely on explicit vertical whitespace steps (`space-2xl` and `space-3xl`) matched with 1px border lines rather than decorative shape fills.

### Breakpoints & Adaptations
- **Mobile (< 768px)**: 4-column flow, 1.25rem canvas margins (`margin`), unified vertical single-column stack. Editorial lead-ins collapse above primary bodies.
- **Tablet (768px – 1024px)**: 8-column layout, 2rem margins, 1.5rem gutters. Side annotations transition into discreet sub-blocks.
- **Desktop (> 1024px)**: Full 12-column asymmetric layout with 4rem canvas margins (`margin-desktop`) and 2.5rem inter-column gutters (`gutter-desktop`).

## Elevation & Depth

This system avoids synthetic drop-shadows and blurred depth simulations. Hierarchy is communicated through architectural alignment, crisp border containment, and paper layering.

### Surface Architecture
- **Base Canvas**: The foundational level is `#FAFAF7` (warm paper tint).
- **Raised Analytical Surfaces**: Elevated modules, data dossiers, and active cards utilize pure `#FFFFFF` background planes bounded by sharp 1px hairline borders (`rgba(20, 33, 61, 0.12)`).
- **Hairline Rule System**: Separation between hierarchy blocks is maintained with 1px solid dividers. Primary section separators use delicate sand accents (`#E9C46A`), while internal card lines use muted ink borders (`rgba(20, 33, 61, 0.08)`).
- **Zero Cast Shadows**: Floating drop shadows, colored ambient glows, and diffuse blur halos are strictly barred. Depth is perceived through physical boundary definition and high-contrast typographic weight.

## Shapes

The design system enforces pure sharp edges (`0px` border radius). 

### Geometry Rationale
- **Architectural Edge**: Every card, input field, button, container, tag, and rule operates with right-angled precision (`0px`).
- **Print Parallels**: Sharp geometry mirrors the crisp cut of untrimmed stock, letterpress matrices, and physical index filing systems.
- **Restraint Over Playfulness**: Pill shapes, rounded bubble buttons, and soft radius corners are incompatible with the calm, authoritative tone of this operations consultancy.

## Components

Components follow quiet, functional editorial mechanics. They avoid dramatic transformations, favoring subtle state transitions and typographic shifts.

### Buttons & Interactive Links
- **Primary Button**: Solid Deep Ink (`#14213D`) fill with warm paper (`#FAFAF7`) typography, 0px radius, 12px vertical by 24px horizontal padding. Hover states subtly lift to an ink tint (`#1F325C`) with a crisp transition.
- **Secondary / Hairline Button**: Ghost state with transparent background, sharp 1px border in `#14213D`, and `#14213D` text. Hover transitions to `#14213D` background and `#FAFAF7` text.
- **Editorial Text Action**: Underlined link using a 1px solid `#E9C46A` hairline positioned 4px below text baseline. Hover transitions the hairline color to `#14213D`.

### Cards & Dossiers
- Background is crisp white (`#FFFFFF`) mounted on the `#FAFAF7` ground.
- Defined by a sharp 1px hairline perimeter border (`rgba(20, 33, 61, 0.1)`).
- Padding is generous and uniform (`space-lg` to `space-xl`).
- Headers often include a top category eyebrow in `label-editorial` styling followed by a 1px hairline divider.

### Chips, Tags & Status Badges
- Strictly rectangular with `0px` radius.
- Standard background is transparent with a 1px border (`#2A9D8F` for active/verified markers, `rgba(20, 33, 61, 0.15)` for neutral).
- Typography is set in `label-editorial` uppercase.
- Statuses are indicated through understated semantic text tags (e.g., `[ VERIFIED ]`, `[ IN REVIEW ]`) rather than saturated dots or candy pills.

### Form Inputs & Controls
- Input fields feature a `#FFFFFF` fill with a 1px solid border in `#6B7280` (at 40% opacity).
- Sharp `0px` corners. Padding is 12px 16px.
- Focus state switches the border to a definitive 1px `#14213D` outline. Glow effects are omitted.
- Labels sit cleanly above the field in `body-sm` weight 500, rendered in `#14213D`.
- Checkboxes and radio selectors use strict geometric boxes (square for checkboxes, sharp diamond or precise circle with inset solid square for radio elements) using `#14213D` line weights.

### Lists, Indexing & Pull-Quotes
- **Numbered Steps**: Multi-step operations feature standalone numerals in the serif display style (`Newsreader`), colored in `#E9C46A` or `#14213D`, followed by horizontal hairline rules dividing each step.
- **Data Tables**: Zero vertical borders. Thin horizontal hairlines between rows. Table header labels set in uppercase with tracked spacing. Numerical data right-aligned in tabular lining.
- **Editorial Pull-Quotes**: Left-aligned, bordered on the left by a single 2px vertical rule in `#14213D` or `#E9C46A`, set in `Newsreader` italic at `headline-md` scale.