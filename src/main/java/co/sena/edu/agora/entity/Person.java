package co.sena.edu.agora.entity;

import lombok.Data;

import jakarta.persistence.*;
import jakarta.validation.constraints.*;
import java.time.LocalDate;
import co.sena.edu.agora.enums.DocumentType;

@Data
@Entity
@Table(name = "persons")
public class Person {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "person_id")
    private Long id;

    @Column(name = "first_name", nullable = false)
    @NotNull
    @Size(min = 2, max = 15)
    private String firstName;

    @Column(name = "last_name", nullable = false)
    @NotNull
    @Size(min = 2, max = 15)
    private String lastName;

    @Enumerated(EnumType.STRING)
    @Column(name = "document_type", nullable = false)
    @NotNull
    private DocumentType documentType;

    @Column(name = "document_number", nullable = false, unique = true)
    @NotNull
    private String documentNumber;

    @Column(name = "phone")
    @Pattern(regexp = "^\\d{10}$", message = "Phone number must be 10 digits")
    private String phone;

    @Column(name = "email")
    @Email
    private String email;

    @Column(name = "address")
    private String address;

    @Column(name = "birth_date")
    @Past
    @NotNull
    private LocalDate birthDate;

    @Column(name = "state", nullable = false)
    @NotNull
    private Boolean state = true;
}
