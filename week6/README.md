PART 1 – NORMALIZATION CHALLENGE
1. Student_Grades_Raw (Unnormalized)

Columns:

* StudentID
* StudentName
* CourseID
* CourseName
* ProfessorName
* ProfessorEmail
* Grade

Example Data

| StudentID | StudentName | CourseID | CourseName       | ProfessorName | ProfessorEmail                      | Grade |
| --------- | ----------- | -------- | ---------------- | ------------- | ----------------------------------- | ----- |
| 1         | Nguyen An   | 101      | Database Systems | Dr. Le        | [le@uni.edu](mailto:le@uni.edu)     | A     |
| 1         | Nguyen An   | 102      | Web Development  | Dr. Tran      | [tran@uni.edu](mailto:tran@uni.edu) | B+    |
| 2         | Tran Binh   | 101      | Database Systems | Dr. Le        | [le@uni.edu](mailto:le@uni.edu)     | A-    |

---

TASK 1

1. Redundant Columns

Some columns contain repeated data:

* StudentName repeats whenever a student takes multiple courses.
* CourseName repeats for each student enrolled in the same course.
* ProfessorName repeats for each course row.
* ProfessorEmail repeats multiple times.

This redundancy increases storage usage and can lead to inconsistent data.

2. Update Anomalies

Professor Email Change: If a professor changes their email address, the update must be made in multiple rows. If one row is not updated, the data becomes inconsistent.

Course Rename: If the course name changes (for example, "Database Systems"), every row containing that course must be updated.

Student Name Change: If a student changes their name, the change must also be applied to multiple rows.

1. Transitive Dependencies

The table contains several transitive dependencies:

* StudentID → StudentName
* CourseID → CourseName
* ProfessorName → ProfessorEmail

These dependencies violate Third Normal Form (3NF) because non-key attributes depend on other non-key attributes.

TASK 2

To eliminate redundancy and anomalies, the table is decomposed into four tables:

* Students
* Courses
* Professors
* Enrollments

Schema Draft

| Table       | Primary Key           | Foreign Keys        | Non-key Columns               |
| ----------- | --------------------- | ------------------- | ----------------------------- |
| Students    | StudentID             | None                | StudentName                   |
| Courses     | CourseID              | ProfessorID         | CourseName                    |
| Professors  | ProfessorID           | None                | ProfessorName, ProfessorEmail |
| Enrollments | (StudentID, CourseID) | StudentID, CourseID | Grade                         |

Explanation of Each Table

- Students: Stores information about students.

Attributes:
* StudentID (Primary Key)
* StudentName

- Professors: Stores information about professors.

Attributes:
* ProfessorID (Primary Key)
* ProfessorName
* ProfessorEmail

- Courses: Stores course information and links each course to a professor.

Attributes:
* CourseID (Primary Key)
* CourseName
* ProfessorID (Foreign Key referencing Professors)
  
- Enrollments: Represents the relationship between students and courses.

Attributes:

* StudentID (Foreign Key referencing Students)
* CourseID (Foreign Key referencing Courses)
* Grade

Primary Key: StudentID, CourseID

--> Conclusion

The schema is decomposed into four tables (Students, Professors, Courses, and Enrollments) to eliminate redundancy and update anomalies.
This design ensures that the database structure satisfies Third Normal Form (3NF).

PART 2 – RELATIONSHIPS

AUTHOR – BOOK: One-to-Many (1:N). One author can write many books. Foreign key is stored in the "Book" table.

CITIZEN – PASSPORT: One-to-One (1:1). One citizen has one passport. Foreign key is stored in the "Passport" table.

CUSTOMER – ORDER: One-to-Many (1:N). One customer can place many orders. Foreign key is stored in the "Order" table.

STUDENT – CLASS: Many-to-Many (M:N). A student can join many classes and a class can have many students. This relationship is implemented through an "Enrollment" table.

TEAM – PLAYER: One-to-Many (1:N). One team has many players. Foreign key is stored in the "Player" table.