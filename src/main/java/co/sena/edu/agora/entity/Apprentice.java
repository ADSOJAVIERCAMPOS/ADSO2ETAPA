package co.sena.edu.agora.entity;

import jakarta.persistence.*;
import lombok.Data;

@Data
@Entity
@Table(name = "apprentices")
public class Apprentice {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "apprentice_id")
    private Long id;

    @ManyToOne
    @JoinColumn(name = "person_id", nullable = false)
    private Person person;

    @Column(name = "record_number", nullable = false)
    private String recordNumber;

    @Column(name = "record_type", nullable = false)
    private String recordType;
}
