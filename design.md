# DESIGN.md — Siwayut Catering

Design System Brief for Google Stitch

---

# Product Identity

**Name:** Siwayut Catering

**Type:** Web-based catering management system

**Core Purpose:**  
A professional internal platform for managing catering operations including:

- Order management
- Customer management
- Menu/package management
- User administration
- Authentication & role control
- Dashboard analytics
- File/document uploads
- Operational workflow visibility

Target users:

- Admin
- Catering manager
- Staff/operator
- Finance/owner (read-only analytics)

---

# Brand Direction

Visual personality:

- Clean
- Premium but approachable
- Trustworthy
- Organized
- Efficient
- Operationally serious
- Slightly warm (food business)

Avoid:

- Playful startup aesthetics
- Overly corporate enterprise stiffness
- Excessive gradients
- Neon/glassmorphism overload
- Dark hacker themes

Desired emotional feel:

> “Reliable catering operations software that feels modern, calm, and efficient.”

---

# Design Style

Primary style:

Modern dashboard SaaS with subtle hospitality warmth

Blend inspiration from:

- Linear
- Notion
- Stripe Dashboard
- Vercel admin systems
- Toast POS dashboard
- Bento-grid modern SaaS

UI characteristics:

- Soft rounded corners (12–18px)
- Spacious layout
- Clear hierarchy
- Excellent whitespace
- Sharp typography
- Low-noise interface
- Subtle shadows
- Minimal border usage
- Strong content grouping

---

# Color System

Primary:

Warm deep green  
`#1E5B4F`

Secondary:

Soft cream  
`#F7F4EE`

Accent:

Muted gold  
`#C8A96A`

Success:

`#2E7D32`

Warning:

`#F59E0B`

Danger:

`#DC2626`

Neutral grayscale:

`#111827`
`#374151`
`#6B7280`
`#D1D5DB`
`#F9FAFB`

Rules:

- Use cream as soft background
- Use green for trust/action
- Use gold sparingly for premium emphasis
- Avoid saturated rainbow palettes

---

# Typography

Primary:

Inter

Fallback:

system-ui, sans-serif

Hierarchy:

H1 → 36 / 700  
H2 → 28 / 700  
H3 → 22 / 600  
Body → 16 / 400  
Small → 14 / 400  
Caption → 12 / 500

Style:

- Tight consistent spacing
- Professional dashboard rhythm
- Avoid decorative display fonts

---

# Layout Principles

Desktop-first responsive admin system

Grid:

12-column

Max content width:

1440px

Spacing scale:

8 / 12 / 16 / 24 / 32 / 48 / 64

Components align to strong visual rhythm.

Navigation:

Left persistent sidebar  
Top utility bar

Content zones:

- Summary cards
- Tables
- Forms
- Analytics widgets
- Activity feed
- Modal workflows

---

# Navigation Architecture

Sidebar:

- Dashboard
- Orders
- Customers
- Menus & Packages
- Uploads
- Reports
- Users
- Settings

Top bar:

- Search
- Notifications
- User profile
- Quick actions

Breadcrumbs required.

---

# Core Screens

## 1. Login

Professional authentication page

Include:

- Logo
- Welcome copy
- Email/password
- Remember me
- Login CTA
- Validation feedback

Layout:

Centered split-screen

Left:
Brand illustration / food operations visual

Right:
Card login form

---

## 2. Dashboard

Executive operational overview

Widgets:

- Total active orders
- Revenue summary
- Pending tasks
- Customer count
- Daily schedule
- Recent activity
- Order trend chart

Layout:

Bento grid

---

## 3. Orders Management

Data-heavy table interface

Include:

- Search
- Filters
- Status chips
- Sort
- Pagination
- Bulk actions

Statuses:

- Pending
- Confirmed
- Preparing
- Delivered
- Completed
- Cancelled

Right-side detail drawer preferred.

---

## 4. Customer Management

CRM-style list view

Cards or table hybrid

Include:

- Contact info
- Order history
- Notes
- Last interaction
- Quick actions

---

## 5. Menu / Package Management

Visual catalog management

Card-based

Each card:

- Food image
- Package name
- Price
- Availability
- Edit actions

Supports:

Create/edit modal

---

## 6. User Administration

Admin CRUD interface

Columns:

- Name
- Email
- Role
- Status
- Last login
- Actions

Roles:

- Admin
- Manager
- Staff
- Viewer

---

## 7. File Upload Center

Clean drag-drop zone

Features:

- Upload progress
- File preview
- Metadata
- Delete/download actions

---

## 8. Settings

Segmented tabs:

- General
- Branding
- Security
- Notifications
- System config

---

# Component Design Rules

Buttons:

- Rounded lg
- Medium weight
- Distinct hover states

Cards:

- Soft elevation
- Clear padding
- Minimal border

Inputs:

- Large hit area
- Inline validation
- Clear labels

Tables:

- Spacious rows
- Sticky header
- Hover highlight

Modals:

- Large enough for workflows
- Not cramped

Charts:

Minimal + analytical clarity

---

# Motion & Interaction

Micro-interactions only

Allowed:

- Fade
- Slide-up
- Scale hover
- Smooth page transition

Duration:

150–250ms

Avoid:

- Bouncy motion
- Flashy transforms
- Over-animation

---

# Accessibility

Must satisfy:

WCAG AA contrast

Include:

- Keyboard navigable
- Focus states
- Semantic structure
- Proper aria labels
- Clear validation messaging

---

# Responsive Behavior

Desktop:

Full dashboard

Tablet:

Collapsible sidebar

Mobile:

Stacked cards + drawer nav

No desktop shrink-squish layouts.

---

# Empty States

Elegant operational empty states

Examples:

- No orders today
- No customers yet
- Upload first document

Illustrative but minimal.

---

# Data Visualization Style

Professional analytics only

Preferred:

- Line charts
- Bar charts
- KPI cards
- Progress indicators

Avoid:

- 3D charts
- Donuts everywhere
- Decorative chart clutter

---

# Output Goal

Generate a polished production-ready catering management dashboard UI that feels:

- Trustworthy
- Calm
- Operationally powerful
- Modern
- Premium
- Efficient
- Easy to scan quickly

The interface should feel like software real businesses would confidently run daily operations on.
