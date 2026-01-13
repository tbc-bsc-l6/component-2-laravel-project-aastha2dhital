# Educational Admin Site (Component 2) — Laravel

Role-based educational administrative system with **4 user types**:

- **Admin**
- **Teacher**
- **Student (Current)**
- **Old Student**

Built using Laravel with Breeze authentication + Tailwind UI.

---

## Assignment Requirements Covered

###  Administrator(s) (Admin Section)
- Admin account **cannot be created directly** (created only via seeder)
- Admin can **add a new module** (CRUD)
- Admin can **create / remove teachers**
- Admin can **remove students from a module**
- Admin can **attach a teacher to a module**
- Admin can **change user roles** (student ↔ old_student / teacher etc.)
- Admin can **toggle modules available/unavailable**
- Admin can **archive modules** without deleting history

###  Teacher(s) (Teacher Section)
- Teachers **cannot self-register** (created by admin)
- Teachers can **view modules assigned by admin**
- Teachers can **view students enrolled in a module**
- Teachers can set **PASS / FAIL** (timestamps module completion for student)

###  Student(s)
- Students can **sign up** (register)
- Students can enroll in **maximum 4 active modules**
- Students can see **completed module history** with PASS/FAIL
- Students can view/enrol in **available modules** if not at max

###  Old Student(s)
- Old Students can only see **completed modules + PASS/FAIL status**

###  Module Rules
- Modules have a maximum of **10 students**
- If full, students cannot enroll until a space becomes available
- Archiving a module makes it unavailable for new enrolments but **keeps history**
- Module enrolment tracks:
  - **enrolled_at**
  - **pass_status**
  - **completed_at**

---

## Tech Stack
- Laravel (PHP)
- Laravel Breeze (Auth scaffolding)
- TailwindCSS + Vite
- SQLite (default)

